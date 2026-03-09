import JabatanController from "@/actions/App/Http/Controllers/JabatanController";
import AppLayout from "@/layouts/app-layout";
import InputError from "@/components/input-error";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Form } from "@inertiajs/react";
import { useState } from "react";
import { Pencil } from "lucide-react";


export default function ShowJabatan({ data }: any) {

    // const [jabatanData, setJabatanData] = useState<any>(data);
    const [namaJabatan, setNamaJabatan] = useState<string>(data.nama);
    return (
        <AppLayout>
            <div className="p-10">
                <Form
                    action={JabatanController.update(data.id)}
                >
                    {({ errors }) => (
                        <>
                            <div>
                                <Label htmlFor="name">Nama Jabatan</Label>
                                <Input name="name" type="text" placeholder="Nama Jabatan" value={namaJabatan} onChange={e => setNamaJabatan(e.target.value)}></Input>
                            </div>
                            <InputError message={errors.name} />
                            <div className="py-5">
                                <Button className="py-4"><Pencil />Ubah Jabatan</Button>
                            </div>
                        </>
                    )}

                </Form>

            </div>
        </AppLayout>
    )
}