import { DataTable } from "./data-table";
import { columns, karyawans } from "./columns";
import AppLayout from "@/layouts/app-layout";
import { karyawan } from '@/routes';
import type { BreadcrumbItem } from '@/types';
import { Head } from "@inertiajs/react";
import { useState } from "react";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Karyawan',
        href: karyawan(),
    },
];


export default function KaryawanIndex({ karyawan }: { karyawan: karyawans[] }) {
    // const [session, setSession] => useState(window.sessionStorage('status'));
    const data = karyawan;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Karyawan" />
            <div className="container mx-auto px-10">
                <h1 className="text-2xl font-bold mb-4">Karyawan</h1>
                <DataTable columns={columns} data={data} />
            </div>
        </AppLayout>

    )
}