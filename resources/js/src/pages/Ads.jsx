import React, { useState } from 'react';
import { useQuery } from '@tanstack/react-query';
import api from '../services/api';
import AdTimerComponent from '../components/AdTimerComponent';

export default function Ads() {
    const [selectedAd, setSelectedAd] = useState(null);

    const { data, isLoading, isError, error, refetch } = useQuery({
        queryKey: ['ads'],
        queryFn: () => api.get('/ads').then((res) => res.data),
    });

    if (isLoading) return <div className="p-6 text-center text-gray-500">Loading ads...</div>;
    if (isError) return <div className="p-6 text-center text-red-500">Error: {error.message}</div>;

    const ads = data?.data?.ads || [];

    const handleAdComplete = () => {
        setSelectedAd(null);
        refetch();
    };

    return (
        <div className="bg-white p-6 rounded shadow max-w-4xl mx-auto">
            <h2 className="text-2xl font-semibold mb-6 border-b pb-4">Available Ads</h2>

            {selectedAd ? (
                <div className="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-100">
                    <h3 className="text-lg font-medium text-gray-800 mb-2">Viewing Ad: {selectedAd.title}</h3>
                    <p className="text-gray-600 mb-4 text-sm break-all">
                        <a href={selectedAd.url} target="_blank" rel="noopener noreferrer" className="text-blue-500 hover:underline">
                            {selectedAd.url}
                        </a>
                    </p>

                    {/* Render the core Timer Engine Component */}
                    <AdTimerComponent
                        ad={selectedAd}
                        onComplete={handleAdComplete}
                        onCancel={() => setSelectedAd(null)}
                    />
                </div>
            ) : (
                <>
                    {ads.length === 0 ? (
                        <p className="text-gray-500 text-center py-8">No ads available at the moment. Check back later!</p>
                    ) : (
                        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {ads.map((ad) => (
                                <div key={ad.id} className="border p-4 rounded-lg flex flex-col justify-between hover:shadow-md transition">
                                    <div>
                                        <h4 className="font-semibold text-lg text-gray-800">{ad.title}</h4>
                                        <div className="text-sm text-gray-500 mb-4 flex justify-between mt-2">
                                            <span>Reward: <strong className="text-green-600">${ad.reward_amount}</strong></span>
                                            <span>Duration: <strong>{ad.duration_seconds}s</strong></span>
                                        </div>
                                    </div>
                                    <button
                                        onClick={() => setSelectedAd(ad)}
                                        className="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition"
                                    >
                                        View Ad
                                    </button>
                                </div>
                            ))}
                        </div>
                    )}
                </>
            )}
        </div>
    );
}
