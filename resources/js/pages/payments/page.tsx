import { columns, Payment } from "./columns"
import { DataTable } from "./data-table"



const getDatas: Payment[] = [
    {
        id: "728ed52f",
        amount: 100,
        status: "pending",
        email: "m@example.com",
    },
]

export default function Page() {
    const data = getDatas;

    return (
        <div className="container mx-auto py-10">
            <DataTable columns={columns} data={data} />
        </div>
    )
}