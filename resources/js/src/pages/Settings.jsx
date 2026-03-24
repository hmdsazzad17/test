import React, { useState } from 'react';
import { useQuery, useMutation } from '@tanstack/react-query';
import api from '../services/api';
import useAuthStore from '../store/authStore';

export default function Settings() {
    const user = useAuthStore((state) => state.user);
    const isAdmin = user?.role === 'admin';

    const { data: usersData, refetch: refetchUsers } = useQuery({
        queryKey: ['admin_users'],
        queryFn: () => api.get('/admin/users').then((res) => res.data),
        enabled: isAdmin,
    });

    const { data: adsData, refetch: refetchAds } = useQuery({
        queryKey: ['admin_ads'],
        queryFn: () => api.get('/admin/ads').then((res) => res.data),
        enabled: isAdmin,
    });

    const { data: withdrawalsData, refetch: refetchWithdrawals } = useQuery({
        queryKey: ['admin_withdrawals'],
        queryFn: () => api.get('/admin/withdrawals').then((res) => res.data),
        enabled: isAdmin,
    });

    const actionMutation = useMutation({
        mutationFn: ({ endpoint, method = 'put', data = {} }) => api[method](endpoint, data),
        onSuccess: () => {
            refetchUsers();
            refetchAds();
            refetchWithdrawals();
        },
        onError: (error) => {
            alert(error.response?.data?.message || 'Action failed.');
        }
    });

    return (
        <div className="max-w-6xl mx-auto space-y-6">
            <h2 className="text-2xl font-semibold border-b pb-4">Settings</h2>

            <div className="bg-white p-6 rounded shadow mb-6">
                <h3 className="text-xl font-medium mb-4 text-gray-800">Profile Information</h3>
                <div className="space-y-2 text-gray-700">
                    <p><strong>Name:</strong> {user?.name}</p>
                    <p><strong>Email:</strong> {user?.email}</p>
                    <p><strong>Role:</strong> {user?.role}</p>
                </div>
            </div>

            {isAdmin && (
                <div className="space-y-6 border-t-4 border-red-500 pt-6">
                    <h2 className="text-2xl font-bold text-red-600">Admin Control Panel</h2>

                    {/* Users Management */}
                    <div className="bg-white p-6 rounded shadow border border-gray-200">
                        <h3 className="text-lg font-medium mb-4">User Management</h3>
                        <div className="overflow-x-auto">
                            <table className="w-full text-left text-sm border-collapse">
                                <thead>
                                    <tr className="border-b bg-gray-50">
                                        <th className="p-2">ID</th>
                                        <th className="p-2">Name</th>
                                        <th className="p-2">Email</th>
                                        <th className="p-2">Role</th>
                                        <th className="p-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {usersData?.data?.users?.map(u => (
                                        <tr key={u.id} className="border-b last:border-0 hover:bg-gray-50">
                                            <td className="p-2">{u.id}</td>
                                            <td className="p-2">{u.name}</td>
                                            <td className="p-2">{u.email}</td>
                                            <td className="p-2 capitalize">{u.role}</td>
                                            <td className="p-2">
                                                {u.role !== 'admin' && (
                                                    <button
                                                        onClick={() => actionMutation.mutate({ endpoint: `/admin/users/${u.id}/ban`, method: 'post' })}
                                                        disabled={actionMutation.isPending}
                                                        className={`px-3 py-1 rounded text-white text-xs ${u.role === 'banned' ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600'}`}
                                                    >
                                                        {u.role === 'banned' ? 'Unban' : 'Ban'}
                                                    </button>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {/* Ads Moderation */}
                    <div className="bg-white p-6 rounded shadow border border-gray-200">
                        <h3 className="text-lg font-medium mb-4">Ad Moderation</h3>
                        <div className="overflow-x-auto">
                            <table className="w-full text-left text-sm border-collapse">
                                <thead>
                                    <tr className="border-b bg-gray-50">
                                        <th className="p-2">ID</th>
                                        <th className="p-2">Advertiser</th>
                                        <th className="p-2">Title</th>
                                        <th className="p-2">Reward</th>
                                        <th className="p-2">Status</th>
                                        <th className="p-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {adsData?.data?.ads?.map(ad => (
                                        <tr key={ad.id} className="border-b last:border-0 hover:bg-gray-50">
                                            <td className="p-2">{ad.id}</td>
                                            <td className="p-2">{ad.advertiser?.name}</td>
                                            <td className="p-2">{ad.title}</td>
                                            <td className="p-2">${ad.reward_amount}</td>
                                            <td className="p-2 capitalize">{ad.status}</td>
                                            <td className="p-2 flex gap-2">
                                                {ad.status === 'pending' && (
                                                    <>
                                                        <button
                                                            onClick={() => actionMutation.mutate({ endpoint: `/admin/ads/${ad.id}/status`, data: { status: 'active' } })}
                                                            className="px-3 py-1 rounded bg-green-500 text-white hover:bg-green-600 text-xs"
                                                        >
                                                            Approve
                                                        </button>
                                                        <button
                                                            onClick={() => actionMutation.mutate({ endpoint: `/admin/ads/${ad.id}/status`, data: { status: 'rejected' } })}
                                                            className="px-3 py-1 rounded bg-red-500 text-white hover:bg-red-600 text-xs"
                                                        >
                                                            Reject
                                                        </button>
                                                    </>
                                                )}
                                                {ad.status === 'active' && (
                                                    <button
                                                        onClick={() => actionMutation.mutate({ endpoint: `/admin/ads/${ad.id}/status`, data: { status: 'rejected' } })}
                                                        className="px-3 py-1 rounded bg-red-500 text-white hover:bg-red-600 text-xs"
                                                    >
                                                        Reject
                                                    </button>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {/* Withdrawals Processing */}
                    <div className="bg-white p-6 rounded shadow border border-gray-200">
                        <h3 className="text-lg font-medium mb-4">Withdrawal Processing</h3>
                        <div className="overflow-x-auto">
                            <table className="w-full text-left text-sm border-collapse">
                                <thead>
                                    <tr className="border-b bg-gray-50">
                                        <th className="p-2">ID</th>
                                        <th className="p-2">User</th>
                                        <th className="p-2">Amount</th>
                                        <th className="p-2">Method</th>
                                        <th className="p-2">Status</th>
                                        <th className="p-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {withdrawalsData?.data?.withdrawals?.map(w => (
                                        <tr key={w.id} className="border-b last:border-0 hover:bg-gray-50">
                                            <td className="p-2">{w.id}</td>
                                            <td className="p-2">{w.user?.name}</td>
                                            <td className="p-2">${w.amount}</td>
                                            <td className="p-2 uppercase">{w.method}</td>
                                            <td className="p-2 capitalize">{w.status}</td>
                                            <td className="p-2 flex gap-2">
                                                {w.status === 'pending' && (
                                                    <>
                                                        <button
                                                            onClick={() => actionMutation.mutate({ endpoint: `/admin/withdrawals/${w.id}/process`, data: { status: 'approved' } })}
                                                            className="px-3 py-1 rounded bg-green-500 text-white hover:bg-green-600 text-xs"
                                                        >
                                                            Approve
                                                        </button>
                                                        <button
                                                            onClick={() => actionMutation.mutate({ endpoint: `/admin/withdrawals/${w.id}/process`, data: { status: 'rejected' } })}
                                                            className="px-3 py-1 rounded bg-red-500 text-white hover:bg-red-600 text-xs"
                                                        >
                                                            Reject
                                                        </button>
                                                    </>
                                                )}
                                                {w.status === 'approved' && (
                                                    <button
                                                        onClick={() => actionMutation.mutate({ endpoint: `/admin/withdrawals/${w.id}/process`, data: { status: 'paid' } })}
                                                        className="px-3 py-1 rounded bg-blue-500 text-white hover:bg-blue-600 text-xs"
                                                    >
                                                        Mark Paid
                                                    </button>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}
