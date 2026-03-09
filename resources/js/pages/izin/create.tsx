

import IzinController from "@/actions/App/Http/Controllers/IzinController";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import AppLayout from "@/layouts/app-layout";
import { Form } from "@inertiajs/react";
import { Spinner } from "@/components/ui/spinner";
import InputError from '@/components/input-error';
import { Alert, AlertTitle, AlertDescription } from "@/components/ui/alert";
// import { useMemo } from "react";

export default function IzinCreate() {

    return (
        <AppLayout>
            <div className="px-10">
                <h1 className="text-2xl font-bold mb-6">Form Pengajuan Izin</h1>
                <p className="text-sm">Silakan isi formulir di bawah ini untuk mengajukan izin meninggalkan pekerjaan.</p>
                <Form
                    resetOnSuccess={['jenis_izin', 'tanggal', 'alasan']}
                    resetOnError={false}
                    action={IzinController.store()}
                    options={{
                        preserveUrl: true,
                        preserveScroll: true,
                    }}
                    onSubmit={(e) => {
                        e.preventDefault();
                        <Alert>
                            <AlertTitle>Berhasil</AlertTitle>
                            <AlertDescription>Pengajuan izin berhasil dikirim.</AlertDescription>
                        </Alert>
                    }}
                >
                    {({ processing, errors }) => (
                        <>
                            <div>
                                <label className="block text-sm font-medium">Jenis Izin</label>
                                <select
                                    name="jenis_izin"
                                    className="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                    <option value="" selected disabled>Pilih Jenis Izin</option>
                                    <option value="izin">Izin</option>
                                    <option value="cuti">Cuti</option>
                                    <option value="sakit">Sakit</option>
                                </select>
                                <InputError message={errors.jenis_izin} />
                            </div>
                            <div>
                                <label className="block text-sm font-medium">Tanggal</label>
                                <Input type="date" name="tanggal" className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                                <InputError message={errors.tanggal} />
                            </div>
                            <div>
                                <label className="block text-sm font-medium">Alasan</label>
                                <textarea name="alasan" className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-2"></textarea>
                                <InputError message={errors.alasan} />
                            </div>
                            <div>
                                <Button
                                    type="submit"
                                    className="my-4 inline-flex items-center px-4 py-2 border-gray-300 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    disabled={processing}>
                                    {processing && <Spinner />}
                                    Ajukan Izin
                                </Button>
                            </div>
                        </>
                    )}

                </Form>
            </div>
        </AppLayout >
    )
}