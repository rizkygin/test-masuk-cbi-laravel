import DepartemenController from "@/actions/App/Http/Controllers/DepartemenController";
import InputError from "@/components/input-error";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import AppLayout from "@/layouts/app-layout";
import { Form } from "@inertiajs/react";
import { useState } from "react";

import { Pencil } from "lucide-react";
export default function ShowDepartemen({ departemen }: any) {
    const [departemenValue, setDepartemen] = useState<string>(departemen.nama);
    return (
        <AppLayout>
            <div className="p-10">
                <Form
                    action={DepartemenController.update(departemen)}
                >
                    {({ errors }) => (
                        <>
                            <div>
                                <Label htmlFor="name">Nama Departemen</Label>
                                <Input name="name" type="text" value={departemenValue} onChange={(e) => {
                                    setDepartemen(e.target.value)
                                }} placeholder="Nama Departemen"></Input>
                            </div>
                            <InputError message={errors.name} />
                            <div className="py-5">
                                <Button className="py-4 bg-yellow-500"><Pencil />Ubah Departemen</Button>
                            </div>
                        </>
                    )}

                </Form>
            </div>

        </AppLayout>
    )
}