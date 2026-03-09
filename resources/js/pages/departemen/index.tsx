import AppLayout from "@/layouts/app-layout";
import { DataTable } from "./data-table";
import { columns } from "./column";
import { Link } from "@inertiajs/react";
import { Button } from "@/components/ui/button";
import DepartemenController from "@/actions/App/Http/Controllers/DepartemenController";

export default function Departemen({ data }: any) {
    const datas = data;
    console.log(data);
    return (
        <AppLayout>
            <div className="p-10 ">
                <div className="flex justify-between">
                    <h1>Departemen</h1>
                    <Link href={DepartemenController.create()}>
                        <Button>Tambah Departemen</Button>
                    </Link>
                </div>

                <DataTable columns={columns} data={datas}></DataTable>
            </div>

        </AppLayout >
    )
}