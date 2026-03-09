import { Head } from '@inertiajs/react';
import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import AppLayout from '@/layouts/app-layout';
import { dashboard } from '@/routes';
import type { BreadcrumbItem } from '@/types';
import { DataTable } from './data-tabel';
import { columns } from './column';
import { Alert, AlertTitle } from '@/components/ui/alert';
import { BadgeCheck } from 'lucide-react'
import { useState, useEffect } from 'react'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
    },
];

export default function Dashboard({ karyawan, user, izin, dataIzin }: any) {
    const data = dataIzin;
    const [getSession, setSession] = useState<string | boolean | null>(sessionStorage.getItem('session'));
    // console.log(getSession);

    useEffect(() => {
        setSession(sessionStorage.getItem('session'));
        setTimeout(() => {
            setSession(null);
        }, 3000);
    }, [sessionStorage.getItem('session')]);
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div style={{ position: 'relative' }}>
                <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                    <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                        <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                            {/* <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" /> */}
                            <h1 className='text-lg font-bold text-center'>Jumlah Karyawan</h1>
                            <h1 className='text-9xl font-bold text-center'>{user}</h1>
                        </div>
                        <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                            {/* <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" /> */}
                            <h1 className='text-lg font-bold text-center'>Total Karyawan Aktif</h1>
                            <h1 className='text-9xl font-bold text-center'>{karyawan}</h1>
                        </div>
                        <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                            {/* <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" /> */}
                            <h1 className='text-lg font-bold text-center'>Jumlah Karyawan Minta Izin Hari ini</h1>
                            <h1 className='text-9xl font-bold text-center'>{izin}</h1>
                        </div>
                    </div>
                    <div className="relative min-h-[100vh] flex-1 overflow-hidden rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                        <div className='px-3'>
                            <DataTable columns={columns} data={data} />

                        </div>
                        {/* <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" /> */}

                    </div>
                </div>
            </div>
            <div style={{ position: 'absolute', top: 0, left: '50%' }}>
                {getSession && <Alert >
                    <BadgeCheck />
                    <AlertTitle>{getSession}</AlertTitle>
                </Alert>}

            </div>

        </AppLayout>
    );
}
