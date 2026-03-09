import DepartemenController from "@/actions/App/Http/Controllers/DepartemenController";
import InputError from "@/components/input-error";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import AppLayout from "@/layouts/app-layout";
import { Form } from "@inertiajs/react";

export default function CreateDepartemen() {
    return (
        <AppLayout>
            <div className="p-10">
                <Form
                    action={DepartemenController.store()}
                >
                    {({ errors }) => (
                        <>
                            <div>
                                <Label htmlFor="name">Nama Departemen</Label>
                                <Input name="name" type="text" placeholder="Nama Departemen"></Input>
                            </div>
                            <InputError message={errors.name} />
                            <div className="py-5">
                                <Button className="py-4">Tambah Departemen</Button>
                            </div>
                        </>
                    )}

                </Form>
            </div>

        </AppLayout>
    )
}