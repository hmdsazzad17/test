import React, { useState, useEffect, useRef } from 'react';
import api from '../services/api';

export default function AdTimerComponent({ ad, onComplete, onCancel }) {
    const [status, setStatus] = useState('idle'); // idle, running, completed, error
    const [timeLeft, setTimeLeft] = useState(ad.duration_seconds);
    const [sessionId, setSessionId] = useState(null);
    const [message, setMessage] = useState('');
    const timerRef = useRef(null);

    // Visibility logic
    useEffect(() => {
        const handleVisibilityChange = () => {
            if (document.hidden && status === 'running') {
                setStatus('error');
                setMessage('Ad paused: You switched tabs. Please restart.');
                clearInterval(timerRef.current);
            }
        };

        document.addEventListener('visibilitychange', handleVisibilityChange);
        return () => {
            document.removeEventListener('visibilitychange', handleVisibilityChange);
        };
    }, [status]);

    useEffect(() => {
        if (status === 'running') {
            timerRef.current = setInterval(() => {
                setTimeLeft((prev) => {
                    if (prev <= 1) {
                        clearInterval(timerRef.current);
                        completeAdSession();
                        return 0;
                    }
                    return prev - 1;
                });
            }, 1000);
        }

        return () => clearInterval(timerRef.current);
    }, [status]);

    const startAdSession = async () => {
        try {
            setStatus('running');
            setMessage('');
            setTimeLeft(ad.duration_seconds);
            const response = await api.post(`/ads/${ad.id}/start`);
            if (response.data.success) {
                setSessionId(response.data.data.session_id);
            }
        } catch (error) {
            setStatus('error');
            setMessage(error.response?.data?.message || 'Failed to start ad session.');
        }
    };

    const completeAdSession = async () => {
        try {
            const response = await api.post(`/ads/${ad.id}/complete`, {
                session_id: sessionId,
                visibility_violations: 0,
            });
            if (response.data.success) {
                setStatus('completed');
                setMessage(`Success! Earned $${response.data.data.reward}`);
                setTimeout(() => onComplete(), 3000); // Trigger reload after 3s
            }
        } catch (error) {
            setStatus('error');
            setMessage(error.response?.data?.message || 'Failed to complete ad session.');
        }
    };

    return (
        <div className="border p-4 rounded shadow-sm bg-gray-50 mt-4">
            <h4 className="font-semibold text-lg">{ad.title}</h4>
            <p className="text-sm text-gray-500 mb-4">Reward: ${ad.reward_amount} | Duration: {ad.duration_seconds}s</p>

            {status === 'idle' && (
                <div className="flex gap-4">
                    <button
                        onClick={startAdSession}
                        className="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition"
                    >
                        Start Viewing
                    </button>
                    <button onClick={onCancel} className="text-gray-500 hover:text-gray-700">
                        Cancel
                    </button>
                </div>
            )}

            {status === 'running' && (
                <div className="flex items-center gap-4">
                    <div className="text-2xl font-mono text-blue-600 font-bold">{timeLeft}s</div>
                    <div className="text-sm text-gray-600">Please wait. Do not switch tabs.</div>
                </div>
            )}

            {status === 'completed' && (
                <div className="text-green-600 font-semibold p-2 bg-green-100 rounded">
                    {message}
                </div>
            )}

            {status === 'error' && (
                <div>
                    <div className="text-red-600 font-semibold p-2 bg-red-100 rounded mb-2">
                        {message}
                    </div>
                    <button onClick={onCancel} className="text-gray-500 underline hover:text-gray-700 text-sm">
                        Go Back
                    </button>
                </div>
            )}
        </div>
    );
}
