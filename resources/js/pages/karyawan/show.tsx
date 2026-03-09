
import AppLayout from "@/layouts/app-layout";
import type { BreadcrumbItem } from '@/types';
import { karyawan } from "@/routes";
import { Form, Head } from "@inertiajs/react";
import employee from "@/public/images/employee.webp"
import { Button } from "@/components/ui/button";
import { update } from "@/actions/App/Http/Controllers/KaryawanController"
import { Input } from "@/components/ui/input";
import { useState } from 'react'


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Karyawan',
        href: karyawan(),
    },
];

export default function KaryawanShow({ karyawan, departemen, jabatan, selectDepartemen, selectJabatan }: any) {

    const [employeeName, setEmployeeName] = useState<string>(karyawan.nama);
    const [employeeDepartemen, setEmployeeDepartemen] = useState<string>(departemen.nama);
    const [employeeJabatan, setEmployeeJabatan] = useState<string>(jabatan.nama)
    // { console.log(departemen) }
    // console.log(karyawan.karyawan.nama);


    // const test = 'HRD';
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title={karyawan.nama} />
            <div className="container mx-auto px-10">

                <h1 className="text-2xl font-bold mb-4">{`Profil Karyawan ${karyawan.nama}`}</h1>
                <div className="flex">
                    <div>
                        <img className="rounded-full w-40 h-40" src={employee} alt="image description" style={{ objectFit: 'cover' }} />
                    </div>
                    <div className="px-10">
                        <Form
                            {...update.put(karyawan)}
                        >
                            <div className="grid h-48 grid-cols-2 place-content-between gap-4 ">

                                <p>Nama</p>
                                <Input name="nama" type="text" value={employeeName} onChange={(value) => setEmployeeName(value.target.value)} />
                                <p>Tanggal Lahir</p>
                                <p>28 Juni 1999</p>
                                <p>Alamat Domisili</p>
                                <p>Kos Kembar Jln. Syutan Sharir Pangkalan Bun</p>
                                <p>Jabatan</p>
                                <select name="jabatan"
                                    className="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                    {selectJabatan.map((item: any) => (
                                        <option key={item.id} value={item.id} selected={item.nama === jabatan.nama}>
                                            {item.nama}
                                        </option>
                                    )
                                    )}
                                </select>
                                <p>Departemen</p>
                                <select name="departemen"
                                    className="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                    {selectDepartemen.map((item: any) => (
                                        <option key={item.id} value={item.id} selected={item.nama === departemen.nama}>
                                            {item.nama}
                                        </option>
                                    )
                                    )}
                                </select>
                                <p> </p>
                                <Button type="submit">Save</Button>

                            </div>

                        </Form>

                    </div>
                </div>
            </div>
        </AppLayout>
    );
}