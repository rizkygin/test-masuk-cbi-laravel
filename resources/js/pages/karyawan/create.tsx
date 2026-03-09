import KaryawanController from "@/actions/App/Http/Controllers/KaryawanController";
import AppLayout from "@/layouts/app-layout";
import { Form, Head } from "@inertiajs/react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { useState } from "react";

export default function CreateKaryawan({ selectDepartemen, selectJabatan }: any) {

    const [nama, setNama] = useState<string>('');
    return (
        <AppLayout>
            <Head title="Tambah Karyawan"></Head>
            <div className="px-10 py-5">
                <Form
                    action={KaryawanController.store()}
                    options={{
                        preserveScroll: true,

                    }}
                    resetOnSuccess

                >
                    <label>
                        Nama
                    </label>
                    <Input type="text" value={nama} name="nama" onChange={(e) => setNama(e.target.value)} />
                    <label>
                        Departemen
                    </label>
                    <select name="departemen"
                        className="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                        {selectDepartemen.map((item: any) => (
                            <option key={item.id} value={item.id} >
                                {item.nama}
                            </option>
                        )
                        )}
                    </select>
                    <label>
                        Jabatan
                    </label>
                    <select name="jabatan"
                        className="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                        {selectJabatan.map((item: any) => (
                            <option key={item.id} value={item.id} >
                                {item.nama}
                            </option>
                        )
                        )}
                    </select>
                    <Button type="submit" className="my-10">Tambah</Button>
                </Form>
            </div>

        </AppLayout>
    )
}