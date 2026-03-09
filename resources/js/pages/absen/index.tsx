import AppLayout from "@/layouts/app-layout";
import { DataTable } from "./data-table";
import { columns } from "./column";
import { Head } from "@inertiajs/react";

export default function Absen({ data }: any) {
    return (
        <AppLayout>
            <Head title="Absen" />
            <div className="px-5 py-5">
                <h1>Rekap Absen</h1>

                <DataTable columns={columns} data={data} />
            </div>
        </AppLayout>
    )
}