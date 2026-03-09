import AbsenController from "@/actions/App/Http/Controllers/AbsenController";
import AppLayout from "@/layouts/app-layout";
import { Form } from "@inertiajs/react";
import { useEffect, useState } from "react";

export default function AbsenPagi({ lastAbsent, yesterdayAbsent }: { lastAbsent: string, yesterdayAbsent: string }) {

    const [time, setTime] = useState(new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }));
    const [alreadyAbsent, setAlreadyAbsent] = useState<boolean>(false);
    const [lastAbsentTime, setLastAbsentTime] = useState<string>(lastAbsent);
    const [yesterdayAbsentTime, setYesterdayAbsentTime] = useState<string>(yesterdayAbsent);
    console.log(lastAbsentTime);

    useEffect(() => {
        const timer = setInterval(() => {
            setTime(new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }));
        }, 1000);
        return () => clearInterval(timer);
    }, []);

    return (
        <AppLayout>
            <div className="py-12">
                <div className="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-8 text-center">

                            {yesterdayAbsentTime && (
                                <div className="mb-6">
                                    <span className="text-sm text-gray-500">Absen Kemarin: </span>
                                    <span className="text-sm font-semibold text-gray-700">{yesterdayAbsentTime}</span>
                                </div>
                            )}


                            <h2 className="text-2xl font-bold text-gray-800 mb-2">Absensi Pagi</h2>
                            <p className="text-gray-500 mb-8">
                                {new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}
                            </p>

                            <div className="flex flex-col items-center justify-center space-y-6">
                                <div className="relative flex items-center justify-center w-40 h-40 rounded-full border-4 border-blue-500 bg-blue-50">
                                    <span className="text-3xl font-mono font-bold text-blue-700">
                                        {time}
                                    </span>
                                </div>
                                {lastAbsentTime && (
                                    <p className="text-gray-500 mb-8">
                                        Anda sudah absen pagi pada {lastAbsentTime}
                                    </p>
                                )}
                                <Form
                                    action={AbsenController.absenPagiStore()}
                                    options={{
                                        preserveScroll: true,
                                        preserveState: false,
                                        preserveUrl: true,
                                        replace: true,
                                        only: ['users', 'flash'],
                                        except: ['secret'],
                                        reset: ['page'],
                                    }}
                                    onSubmit={() => {
                                        setAlreadyAbsent(true);
                                    }}
                                >
                                    <div className="w-full max-w-xs">
                                        <input type="hidden" name="jam" value={time} />
                                        {!lastAbsentTime ? <button type="submit" className="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition-all active:scale-95">
                                            Absen Sekarang
                                        </button> : <span className="w-full bg-gray-600 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition-all active:scale-95">
                                            {`Sudah Absen ${lastAbsent}`}
                                        </span>}

                                    </div>
                                </Form>


                                <div className="text-sm text-gray-400 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Lokasi terdeteksi: Kantor Pusat</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </AppLayout>
    )
}