# Software Requirements Specification (SRS)
## Project: Smart Earn Online (PTC Advertising Platform)
**Version:** 3.0 (Enterprise / AI-Executable)
**Date:** March 24, 2026

---

# 1. Introduction

## 1.1 Purpose
This SRS defines a complete, implementation-grade specification for building the Smart Earn Online platform using Laravel 12 + React + Tailwind + MySQL. It is designed for both human engineers and AI agents to execute development deterministically.

## 1.2 Scope
A dual-sided PTC (Pay-To-Click) ecosystem:
- Earners: view ads and earn rewards
- Advertisers: pay for traffic
- Admin: governance, moderation, finance control

## 1.3 Definitions
- PTC: Pay-To-Click
- CPC: Cost Per Click
- Ad View Session: Timed, validated interaction with an ad

---

# 2. Technology Stack

## Backend
- Laravel 12 (API-first)
- PHP 8.3+
- Laravel Sanctum (auth)

## Frontend
- Public Site: HTML + Tailwind
- Dashboard: React + Tailwind (SPA)
- State: React Query + Zustand

## Data & Infra
- MySQL 8+
- Redis (cache, queue, rate limit)
- Queue Workers (Laravel Horizon optional)

---

# 3. System Architecture

## 3.1 High-Level
Client (Web) → API Gateway (Laravel) → Services → DB (MySQL) + Cache (Redis)

## 3.2 Layers
- Presentation: HTML (landing), React (dashboard)
- API: Controllers, Form Requests, Resources
- Domain: Services (AdService, WalletService, ReferralService)
- Data: Repositories (optional), Eloquent Models
- Infra: Queue, Cache, Rate Limiter

## 3.3 Folder Structure (Laravel)
```
app/
 ├── Models/
 ├── Http/Controllers/API/
 ├── Http/Requests/
 ├── Services/
 ├── Policies/
 ├── Jobs/
 ├── Events/
 └── Listeners/
```

---

# 4. User Roles & Permissions

## 4.1 Guest
- View landing page

## 4.2 Earner
- View ads
- Earn rewards
- View wallet, withdraw
- Referral earnings

## 4.3 Advertiser
- Create/manage ads
- Deposit funds
- Analytics dashboard

## 4.4 Admin
- User moderation
- Ad approval
- Financial operations
- System configuration

## 4.5 RBAC
- roles: [earner, advertiser, admin]
- permissions via policies/guards

---

# 5. Functional Modules

## 5.1 Authentication

### Features
- Email/password registration
- Email verification
- Login/logout
- Password reset
- Optional 2FA (TOTP)

### APIs
```
POST /api/v1/auth/register
POST /api/v1/auth/login
POST /api/v1/auth/logout
POST /api/v1/auth/forgot-password
POST /api/v1/auth/reset-password
GET  /api/v1/user
```

---

## 5.2 Wallet & Ledger (CRITICAL)

### Principles
- No direct balance mutation
- Double-entry style (credit/debit)
- Idempotent operations

### Tables
**users**
- id, name, email, password, role, referral_code, referred_by, created_at

**transactions**
- id
- user_id (index)
- type (credit|debit)
- amount (decimal 12,4)
- source (ad_view|referral|deposit|withdrawal|adjustment)
- reference_type, reference_id (polymorphic)
- status (pending|completed|failed)
- idempotency_key (unique)
- created_at (index)

### Balance Query
```
SELECT SUM(CASE WHEN type='credit' THEN amount ELSE -amount END)
FROM transactions WHERE user_id=? AND status='completed';
```

### Service Contract
- WalletService::credit(user, amount, source, ref)
- WalletService::debit(user, amount, source, ref)

---

## 5.3 Ads & Campaigns

### Tables
**ads**
- id
- advertiser_id (index)
- title
- url
- reward_amount (decimal 10,4)
- duration_seconds (int)
- total_clicks (int)
- remaining_clicks (int, index)
- status (pending|active|paused|completed|rejected)
- country_targets (json)
- device_targets (json)
- created_at

**campaigns (optional)**
- id, user_id, budget, spent, status

### APIs
```
GET  /api/v1/ads
POST /api/v1/ads
PUT  /api/v1/ads/{id}
POST /api/v1/ads/{id}/pause
```

---

## 5.4 Ad View Session (Core Engine)

### Tables
**ad_views**
- id
- user_id (index)
- ad_id (index)
- started_at (index)
- completed_at
- ip_address
- user_agent
- visibility_violations (int)
- status (in_progress|completed|failed|expired)
- reward_given (boolean)
- created_at

### Flow
1. Start Session
```
POST /api/v1/ads/{id}/start
```
- Validate eligibility (not completed before, geo/device match, remaining_clicks>0)
- Create ad_view (status=in_progress)
- Return session token + duration

2. Client Timer & Validation
- Countdown timer
- Visibility API: block on tab hidden
- Heartbeat ping every 5s (optional)

3. Complete Session
```
POST /api/v1/ads/{id}/complete
```

### Server Validations
- elapsed >= duration_seconds
- no duplicate completion
- low visibility violations
- captcha_passed=true
- rate limits OK

### Atomic Operation (DB Transaction)
- Update ad_view.status=completed
- Decrement ads.remaining_clicks (WHERE remaining_clicks>0)
- Insert user credit transaction
- If referral exists → insert referral commission

---

## 5.5 Anti-Cheat System

### Rules
- Max accounts/IP (configurable)
- VPN/Proxy detection (3rd party API)
- Device fingerprint (hash UA + IP + screen hints)
- Tab visibility enforcement
- Randomized captcha on completion
- Cooldown between ads

### Signals Stored
- ip_address
- user_agent
- fingerprint_hash
- anomaly_score

### Rejection Conditions
- time_spent < duration
- multiple completes for same ad
- high anomaly score

---

## 5.6 Referral System

### Tables
**referrals**
- id
- referrer_id (index)
- referred_user_id (unique)
- commission_rate (decimal 5,2)

### Logic
- On earning event: credit referrer = amount * rate
- Tier-based commission (configurable)

---

## 5.7 Withdrawals

### Tables
**withdrawals**
- id
- user_id (index)
- amount
- method (paypal|crypto|bank)
- account_details (json)
- status (pending|approved|rejected|paid)
- processed_by (admin_id)
- created_at (index)

### Rules
- Minimum threshold
- KYC flag (optional)
- Manual or automated payout via queues

---

## 5.8 Deposits (Advertisers)

### Tables
**deposits**
- id, user_id, amount, gateway, status, external_ref, created_at

### Flow
- Create intent → redirect to gateway → webhook confirms → credit advertiser balance

---

## 5.9 Admin Panel

### Features
- User CRUD, ban/suspend
- Ad moderation (approve/reject)
- Withdrawal processing
- Global settings (CPC, limits, referral rates)
- Audit logs

---

# 6. API Standards

## 6.1 Versioning
- Prefix: /api/v1

## 6.2 Response
```
{
  "success": true,
  "message": "",
  "data": {}
}
```

## 6.3 Errors
```
{
  "success": false,
  "error": "VALIDATION_ERROR",
  "message": "...",
  "details": {}
}
```

## 6.4 Idempotency
- Use Idempotency-Key header for financial endpoints

---

# 7. Frontend Architecture (React)

## 7.1 Structure
```
src/
 ├── components/
 ├── pages/
 ├── services/api.js
 ├── store/
 └── hooks/
```

## 7.2 Pages
- Dashboard
- Ads
- Wallet
- Plans
- Settings

## 7.3 Data Fetching
- React Query for caching/retries

## 7.4 State
- Zustand for auth/user/global state

## 7.5 Ad Timer Component
- Manages countdown
- Visibility API
- Calls complete endpoint

---

# 8. Non-Functional Requirements

## 8.1 Performance
- P95 API latency < 300ms (cached reads)
- Dashboard TTFB < 1.5s
- Concurrency: 10k+ active ad sessions

## 8.2 Reliability
- Uptime 99.9%
- Daily backups + point-in-time recovery

## 8.3 Security
- HTTPS only
- Password hashing (bcrypt/argon2)
- CSRF (for web), rate limiting (API)

## 8.4 Scalability
- Horizontal scaling (stateless API)
- Redis for shared cache/session
- Queue workers autoscale

---

# 9. Database Indexing Strategy

- users(email unique)
- transactions(user_id, status, created_at)
- ads(status, remaining_clicks)
- ad_views(user_id, ad_id, status, created_at)
- withdrawals(user_id, status)

---

# 10. Background Jobs & Events

## Jobs
- ProcessWithdrawalJob
- SendEmailJob
- DetectFraudJob

## Events
- AdCompleted
- UserRegistered

## Listeners
- CreditReferralCommission
- SendNotification

---

# 11. Observability

- Logs: structured (JSON)
- Metrics: request rate, error rate, queue depth
- Alerts: failed jobs, payment webhooks

---

# 12. Deployment

## Environments
- dev, staging, production

## CI/CD
- Build → Test → Deploy

## Requirements
- Nginx
- PHP-FPM
- Supervisor (queues)

---

# 13. Development Roadmap (Execution Plan)

## Phase 1 (Core Backend)
- Auth
- Wallet/Transactions
- Ads CRUD
- Ad View Engine

## Phase 2 (Frontend)
- React dashboard
- API integration
- Timer component

## Phase 3 (Monetization)
- Deposits
- Withdrawals
- Referrals

## Phase 4 (Admin & Scaling)
- Admin panel
- Queue optimization
- Caching

---

# 14. AI Agent Development Rules

1. Never mutate balance directly
2. All money flows via transactions table
3. Use DB transactions for atomicity
4. Validate ad completion strictly
5. Use service layer for business logic
6. Ensure idempotency for financial ops

---

# 15. Acceptance Criteria (Key)

- Ad cannot be completed without full duration
- Duplicate rewards are impossible
- Referral commission triggers correctly
- Withdrawals respect thresholds and statuses
- System resists basic bot abuse

---

# 16. Future Enhancements

- Microtasks (surveys, installs)
- Mobile app (React Native)
- Gamification (badges, streaks)
- Advanced targeting (behavioral)

---

# 17. Conclusion

This SRS provides a deterministic, production-grade blueprint for building Smart Earn Online with Laravel 12 + React + Tailwind + MySQL. It is structured for both human teams and AI agents to implement the system reliably, securely, and at scale.

