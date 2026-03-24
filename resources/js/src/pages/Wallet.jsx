import React, { useState } from 'react';
import { useQuery, useMutation } from '@tanstack/react-query';
import api from '../services/api';
import useAuthStore from '../store/authStore';

export default function Wallet() {
    const user = useAuthStore((state) => state.user);
    const [amount, setAmount] = useState('');
    const [method, setMethod] = useState('paypal');
    const [accountDetails, setAccountDetails] = useState('');
    const [withdrawMessage, setWithdrawMessage] = useState('');

    // Fetch transactions
    const { data: transactionsData, refetch } = useQuery({
        queryKey: ['transactions'],
        queryFn: () => api.get('/user').then((res) => {
            // Ideally backend would have a /transactions endpoint but we can mock or wait
            // Let's assume we fetch user stats here or have a dedicated endpoint
            return api.get('/withdrawals').then(r => r.data);
        }),
    });

    // In a real app we'd fetch balance from a dedicated API endpoint like GET /api/v1/wallet/balance
    // For now we'll just implement the withdrawal action and display referrals.

    const withdrawMutation = useMutation({
        mutationFn: (data) => api.post('/withdrawals', data),
        onSuccess: () => {
            setWithdrawMessage('Withdrawal requested successfully!');
            setAmount('');
            setAccountDetails('');
            refetch();
        },
        onError: (error) => {
            setWithdrawMessage(error.response?.data?.message || 'Withdrawal failed.');
        }
    });

    const handleWithdraw = (e) => {
        e.preventDefault();
        setWithdrawMessage('');
        withdrawMutation.mutate({
            amount,
            method,
            account_details: { account: accountDetails },
        });
    };

    return (
        <div className="max-w-4xl mx-auto space-y-6">
            <h2 className="text-2xl font-semibold border-b pb-4">Wallet & Earnings</h2>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                {/* Referrals Section */}
                <div className="bg-purple-50 p-6 rounded shadow border border-purple-100">
                    <h3 className="text-xl font-medium text-purple-800 mb-4">Referral Program</h3>
                    <p className="text-gray-700 mb-2">Invite your friends and earn a 10% commission on their earnings!</p>
                    <div className="bg-white p-3 rounded border border-purple-200 text-center mb-4">
                        <span className="text-sm text-gray-500 block mb-1">Your Referral Code:</span>
                        <strong className="text-xl text-purple-900 tracking-wider">{user?.referral_code || 'N/A'}</strong>
                    </div>
                </div>

                {/* Withdraw Form */}
                <div className="bg-green-50 p-6 rounded shadow border border-green-100">
                    <h3 className="text-xl font-medium text-green-800 mb-4">Request Withdrawal</h3>
                    {withdrawMessage && (
                        <div className={`p-2 mb-4 rounded text-sm ${withdrawMessage.includes('success') ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800'}`}>
                            {withdrawMessage}
                        </div>
                    )}
                    <form onSubmit={handleWithdraw} className="space-y-4">
                        <div>
                            <label className="block text-sm text-gray-700 mb-1">Amount ($)</label>
                            <input
                                type="number"
                                step="0.01"
                                required
                                min="5.00"
                                value={amount}
                                onChange={(e) => setAmount(e.target.value)}
                                className="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                            />
                        </div>
                        <div>
                            <label className="block text-sm text-gray-700 mb-1">Method</label>
                            <select
                                value={method}
                                onChange={(e) => setMethod(e.target.value)}
                                className="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                            >
                                <option value="paypal">PayPal</option>
                                <option value="crypto">Crypto Wallet</option>
                                <option value="bank">Bank Transfer</option>
                            </select>
                        </div>
                        <div>
                            <label className="block text-sm text-gray-700 mb-1">Account Details</label>
                            <input
                                type="text"
                                required
                                value={accountDetails}
                                onChange={(e) => setAccountDetails(e.target.value)}
                                placeholder="Email, Wallet Address, etc."
                                className="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                            />
                        </div>
                        <button
                            type="submit"
                            disabled={withdrawMutation.isPending}
                            className="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 disabled:opacity-50"
                        >
                            {withdrawMessage.includes('success') ? 'Submit Another' : 'Withdraw Funds'}
                        </button>
                    </form>
                </div>
            </div>

            {/* Withdrawal History */}
            <div className="bg-white p-6 rounded shadow">
                <h3 className="text-xl font-medium mb-4">Withdrawal History</h3>
                {transactionsData?.data?.withdrawals?.length > 0 ? (
                    <table className="w-full text-left border-collapse">
                        <thead>
                            <tr className="border-b">
                                <th className="p-2">Date</th>
                                <th className="p-2">Method</th>
                                <th className="p-2">Amount</th>
                                <th className="p-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            {transactionsData.data.withdrawals.map(w => (
                                <tr key={w.id} className="border-b last:border-0 hover:bg-gray-50">
                                    <td className="p-2">{new Date(w.created_at).toLocaleDateString()}</td>
                                    <td className="p-2 capitalize">{w.method}</td>
                                    <td className="p-2">${w.amount}</td>
                                    <td className="p-2">
                                        <span className={`px-2 py-1 rounded text-xs text-white ${
                                            w.status === 'approved' || w.status === 'paid' ? 'bg-green-500' :
                                            w.status === 'rejected' ? 'bg-red-500' : 'bg-yellow-500'
                                        }`}>
                                            {w.status}
                                        </span>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                ) : (
                    <p className="text-gray-500 text-sm">No withdrawals requested yet.</p>
                )}
            </div>
        </div>
    );
}
