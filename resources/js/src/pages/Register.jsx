import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { useMutation } from '@tanstack/react-query';
import api from '../services/api';
import useAuthStore from '../store/authStore';

export default function Register() {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');
    const navigate = useNavigate();
    const loginStore = useAuthStore((state) => state.login);

    const registerMutation = useMutation({
        mutationFn: (userData) => api.post('/auth/register', userData),
        onSuccess: (response) => {
            const { user, token } = response.data.data;
            loginStore(user, token);
            navigate('/dashboard');
        },
        onError: (error) => {
            setError(error.response?.data?.message || 'Registration failed');
        },
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        setError('');
        registerMutation.mutate({ name, email, password });
    };

    return (
        <div className="flex flex-col items-center justify-center min-h-[60vh] bg-gray-100">
            <div className="bg-white p-8 rounded shadow-md w-full max-w-sm">
                <h2 className="text-2xl font-bold mb-6 text-center text-gray-800">Register</h2>
                {error && <div className="text-red-500 text-sm mb-4 bg-red-50 p-2 rounded">{error}</div>}
                <form onSubmit={handleSubmit} className="space-y-4">
                    <div>
                        <label className="block text-gray-700 mb-1" htmlFor="name">Name</label>
                        <input
                            id="name"
                            type="text"
                            className="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value={name}
                            onChange={(e) => setName(e.target.value)}
                            required
                        />
                    </div>
                    <div>
                        <label className="block text-gray-700 mb-1" htmlFor="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            className="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            required
                        />
                    </div>
                    <div>
                        <label className="block text-gray-700 mb-1" htmlFor="password">Password</label>
                        <input
                            id="password"
                            type="password"
                            className="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                            required
                        />
                    </div>
                    <button
                        type="submit"
                        disabled={registerMutation.isPending}
                        className="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition disabled:bg-green-300"
                    >
                        {registerMutation.isPending ? 'Registering...' : 'Register'}
                    </button>
                </form>
                <div className="mt-4 text-center">
                    <span className="text-gray-600">Already have an account? </span>
                    <Link to="/login" className="text-blue-600 hover:underline">Log In</Link>
                </div>
            </div>
        </div>
    );
}
