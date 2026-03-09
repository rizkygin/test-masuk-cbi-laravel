import AbsenController from "@/actions/App/Http/Controllers/AbsenController";
import AppLayout from "@/layouts/app-layout";
import { Form } from "@inertiajs/react";
import { useState, useEffect } from "react";

export default function ({ lastAbsent, yesterdayAbsent, absenPagi }: any) {
    // console.log(yesterdayAbsent);
    const [time, setTime] = useState(new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }));
    const [alreadyAbsent, setAlreadyAbsent] = useState<boolean>(false);
    const [belumAbsenPagi, setBelumAbsenPagi] = useState<boolean>(true);
    const [yesterdayAbsenTime, setYesterdayAbsentTime] = useState<any>(yesterdayAbsent);

    // console.log(lastAbsentTime);
    useEffect(() => {
        const timer = setInterval(() => {
            setTime(new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }));
        }, 1000);
        return () => clearInterval(timer);
    }, []);

    useEffect(() => {
        if (absenPagi) {
            setBelumAbsenPagi(false);
        }
        if (lastAbsent) {
            setAlreadyAbsent(true);
        }
    }, [])
    return (
        <AppLayout>
            <div>
                <div className="max-w-2xl mx-auto p-6">
                    <h1 className="text-2xl font-bold text-gray-800 mb-6">Absen Pulang</h1>
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div className="p-6 bg-white border-b border-gray-200">

                            {yesterdayAbsenTime && <div className="mb-6">
                                <p className="text-sm font-medium text-gray-500">Waktu Absen Pulang Kemarin</p>
                                <p className="text-lg font-bold text-gray-900">{yesterdayAbsent.jam_pulang}</p>
                                <p className="text-sm font-medium text-gray-500">Status Masuk Pagi</p>
                                <p className="text-lg font-bold text-gray-900">{`${yesterdayAbsent.status}`}</p>
                            </div>}


                            {belumAbsenPagi &&
                                <div>
                                    <p className="text-gray-600 mb-4">
                                        Anda Belum Absen Pagi. Absen Pagi Sekarang
                                    </p>
                                    <Form
                                        action={AbsenController.absenPagiStore()}
                                        onSubmit={() => setBelumAbsenPagi(false)}
                                    >
                                        <input type="hidden" name="jam" value={time} />

                                        <button className="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            Absen Pagi
                                        </button>
                                    </Form>
                                </div>

                            }
                            {!belumAbsenPagi &&
                                <div>
                                    <p className="text-gray-600 mb-4">
                                        Pastikan Anda telah menyelesaikan semua tugas sebelum melakukan absen pulang.
                                    </p>
                                    <Form
                                        action={AbsenController.absenPulangStore()}
                                        onSubmit={() => setAlreadyAbsent(true)}
                                    >
                                        <input type="hidden" name="jam" value={time} />

                                        {alreadyAbsent && <span className="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            {`Sudah CheckOut ${lastAbsent}`}
                                        </span>}
                                        {!alreadyAbsent && <button className="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 hover:cursor-pointer active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                            Check Out Sekarang
                                        </button>}

                                    </Form>
                                </div>

                            }
                        </div>
                    </div>
                </div>

            </div>
        </AppLayout>
    )
}