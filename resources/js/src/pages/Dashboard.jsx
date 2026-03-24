import React from 'react';
import { useNavigate, Link } from 'react-router-dom';
import useAuthStore from '../store/authStore';
import api from '../services/api';

export default function Dashboard() {
    const user = useAuthStore((state) => state.user);
    const logout = useAuthStore((state) => state.logout);
    const navigate = useNavigate();

    const handleLogout = async () => {
        try {
            await api.post('/auth/logout');
        } catch (error) {
            console.error('Logout error:', error);
        } finally {
            logout();
            navigate('/login');
        }
    };

    return (
        <div className="bg-white p-6 rounded shadow">
            <div className="flex justify-between items-center mb-6 border-b pb-4">
                <h2 className="text-2xl font-semibold">Dashboard</h2>
                <div className="flex gap-4 items-center">
                    <span className="text-gray-600">Logged in as {user?.name} ({user?.role})</span>
                    <button
                        onClick={handleLogout}
                        className="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition"
                    >
                        Logout
                    </button>
                </div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div className="bg-blue-50 p-6 rounded-lg shadow-sm border border-blue-100">
                    <h3 className="text-lg font-medium text-blue-800 mb-2">Available Ads</h3>
                    <p className="text-gray-600 mb-4">View and complete ads to earn rewards.</p>
                    <Link
                        to="/ads"
                        className="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition"
                    >
                        View Ads
                    </Link>
                </div>

                <div className="bg-green-50 p-6 rounded-lg shadow-sm border border-green-100">
                    <h3 className="text-lg font-medium text-green-800 mb-2">Wallet</h3>
                    <p className="text-gray-600 mb-4">Check your balance and transactions.</p>
                    <button className="bg-green-600 text-white px-4 py-2 rounded opacity-50 cursor-not-allowed">
                        Coming Soon
                    </button>
                </div>

                <div className="bg-purple-50 p-6 rounded-lg shadow-sm border border-purple-100">
                    <h3 className="text-lg font-medium text-purple-800 mb-2">Referrals</h3>
                    <p className="text-gray-600 mb-4">Invite friends and earn commission.</p>
                    <button className="bg-purple-600 text-white px-4 py-2 rounded opacity-50 cursor-not-allowed">
                        Coming Soon
                    </button>
                </div>
            </div>
        </div>
    );
}
