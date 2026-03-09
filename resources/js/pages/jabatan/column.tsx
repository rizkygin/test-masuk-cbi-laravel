import { ColumnDef } from "@tanstack/react-table"
import { Form } from "@inertiajs/react"
import { Link } from "@inertiajs/react"
import { MoreHorizontal, Volleyball, Flame } from "lucide-react"
import { ArrowUpDown } from "lucide-react"
import { Checkbox } from "@/components/ui/checkbox"
// import KaryawanController, { show, destroy } from "@/actions/App/Http/Controllers/KaryawanController"

import { Button } from "@/components/ui/button"
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"
import IzinController from "@/actions/App/Http/Controllers/IzinController"
import DepartemenController from "@/actions/App/Http/Controllers/DepartemenController"
import JabatanController from "@/actions/App/Http/Controllers/JabatanController"

export type jabatan = {
    id: number,
    jabatan: string,
}


export const columns: ColumnDef<jabatan>[] = [

    {
        accessorKey: 'jabatan',
        header: ({ column }) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
                >
                    Departemen
                    <ArrowUpDown className="ml-2 h-4 w-4" />
                </Button>
            )
        },
    },
    {
        accessorKey: '',
        header: 'aksi',
        cell: ({ row }) => {
            const jabatan = row.original
            return (
                <div className="flex gap-3">
                    <Link href={JabatanController.show(jabatan.id)}>
                        <Button className="bg-yellow-400 hover:cursor-pointer">Edit</Button>
                    </Link>
                    <Form
                        action={JabatanController.destroy(jabatan.id)}
                    >
                        <Button type="submit" className="bg-red-300 hover:bg-red-900 hover:cursor-pointer">
                            Hapus
                        </Button>
                    </Form>
                </div>

            )
        }
    },


]