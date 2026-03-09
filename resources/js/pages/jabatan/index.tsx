import AppLayout from "@/layouts/app-layout";
import { DataTable } from "./data-table";
import { columns } from "./column";
import JabatanController from "@/actions/App/Http/Controllers/JabatanController";
// import { Link } from "lucide-react";
import { Link } from "@inertiajs/react";
import { Button } from "@/components/ui/button";

export default function IndexJabatan({ data }: any) {
    return (
        <AppLayout>
            <div className="px-10 py-5">
                <div className="flex justify-between">
                    <h1>Kelola Jabatan</h1>
                    <Link href={JabatanController.create()}><Button>Tambah Jabatan</Button></Link>
                </div>
                <DataTable columns={columns} data={data} />
            </div>

        </AppLayout>
    )
}