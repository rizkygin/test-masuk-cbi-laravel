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
import { karyawan } from "@/routes"

export type izin = {
    id: number,
    karyawan: string,
    tanggal: string,
    keterangan: string,
    alasan: string,
    status: string,
    disetujui_oleh: string
}


export const columns: ColumnDef<izin>[] = [
    {
        id: "select",
        header: ({ table }) => (
            <Checkbox
                checked={
                    table.getIsAllPageRowsSelected() ||
                    (table.getIsSomePageRowsSelected() && "indeterminate")
                }
                onCheckedChange={(value) => table.toggleAllPageRowsSelected(!!value)}
                aria-label="Select all"
            />
        ),
        cell: ({ row }) => (
            <Checkbox
                checked={row.getIsSelected()}
                onCheckedChange={(value) => row.toggleSelected(!!value)}
                aria-label="Select row"
            />
        ),
        enableSorting: false,
        enableHiding: false,
    },
    {
        accessorKey: 'karyawan',
        header: 'Karyawan'
    },
    {
        accessorKey: "tanggal",
        header: ({ column }) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
                >
                    Tanggal
                    <ArrowUpDown className="ml-2 h-4 w-4" />
                </Button>
            )
        },
    },
    {
        accessorKey: "status",
        header: ({ column }) => {
            return (
                <Button
                    variant="ghost"
                    onClick={() => column.toggleSorting(column.getIsSorted() === "asc")}
                >
                    Status
                    <ArrowUpDown className="ml-2 h-4 w-4" />
                </Button>
            )
        },
    },
    {
        accessorKey: "keterangan",
        header: "Jenis Izin",
    },

    {
        accessorKey: "Aksi",
        header: "Setujui",
        cell: ({ row }) => {
            const izin = row.original

            return (
                <DropdownMenu>
                    <DropdownMenuTrigger asChild>
                        <Button variant="ghost" className="h-8 w-8 p-0">
                            <span className="sr-only">Open menu</span>
                            <MoreHorizontal className="h-4 w-4" />
                        </Button>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent align="end">
                        <DropdownMenuLabel>Actions</DropdownMenuLabel>
                        <DropdownMenuItem
                        >
                            <Form
                                action={IzinController.update(izin.id)}

                            >
                                {({ processing }) => (
                                    <>
                                        <input type="hidden" name="status" value="approved" />
                                        <Button type="submit" disabled={processing} className="w-40 hover:bg-green-500 cursor-pointer">
                                            <Volleyball />
                                            Approve Izin Ini
                                        </Button>
                                    </>
                                )}

                            </Form>

                        </DropdownMenuItem>
                        <DropdownMenuItem
                        // onClick={() => navigator.clipboard.writeText(karyawan.nama)}
                        >
                            <Form
                                action={IzinController.update(izin.id)}

                            >
                                <input type="hidden" name="status" value="rejected" />
                                <Button type="submit" className="hover:bg-red-500 w-40 cursor-pointer">
                                    <Flame />
                                    Reject Izin ini
                                </Button>
                            </Form>

                        </DropdownMenuItem>
                    </DropdownMenuContent>

                </DropdownMenu >
            )
        }
    },
]