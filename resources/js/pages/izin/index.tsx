import { DataTable } from "./data-table";
import { columns, izin } from "./columns";
import AppLayout from "@/layouts/app-layout";
import { karyawan } from '@/routes';
import type { BreadcrumbItem } from '@/types';
import { Head } from "@inertiajs/react";
import { Button } from "@/components/ui/button";
import KaryawanController from "@/actions/App/Http/Controllers/KaryawanController";
// import IzinCreate from "./create";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Izin',
        href: '',
    },
];


export default function KaryawanIndex({ izin }: { izin: izin[] }) {
    const data = izin;
    console.log(izin);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Karyawan" />
            <div className="container mx-auto px-10">
                <div className="flex justify-between">
                    <h1 className="text-2xl font-bold mb-4">Karyawan</h1>
                    {/* <a href={KaryawanController.create.url()}><Button>Tambah Karyawan</Button></a> */}
                </div>
                <DataTable columns={columns} data={data} />
            </div>
        </AppLayout>

    )
}