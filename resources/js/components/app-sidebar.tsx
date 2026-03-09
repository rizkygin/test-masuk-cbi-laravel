import { Link } from '@inertiajs/react';
import { IdCard, Building2, LayoutGrid, SunDim, Moon, LetterText, MailCheck, AlarmCheckIcon } from 'lucide-react';
import AppLogo from '@/components/app-logo';
import { NavFooter } from '@/components/nav-footer';

import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard, karyawan, departemen, absenPagi, absenPulang, izinTidakMasukCreate, kelolaIzin, rekapAbsen, kelolaDepartemen, kelolaJabatan } from '@/routes';
// import AbsenController
// import IzinController from '@/controllers/IzinController';
import type { NavItem } from '@/types';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Absen Pagi',
        href: absenPagi(),
        icon: SunDim,
    },
    {
        title: 'Absen Pulang',
        href: absenPulang(),
        icon: Moon,
    },
    {
        title: 'Izin Tidak Masuk',
        href: izinTidakMasukCreate(),
        icon: LetterText,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Rekap Absen',
        href: rekapAbsen(),
        icon: AlarmCheckIcon,
    },
    {
        title: 'Kelola Izin',
        href: kelolaIzin(),
        icon: MailCheck,
    },
    {
        title: 'Kelola Karyawan',
        href: karyawan(),
        icon: IdCard,
    },
    {
        title: 'Kelola Departemen',
        href: kelolaDepartemen(),
        icon: Building2,
    },
    {
        title: 'Kelola Jabatan',
        href: kelolaJabatan(),
        icon: Building2,
    },
];

export function AppSidebar() {
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href={dashboard()}>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
