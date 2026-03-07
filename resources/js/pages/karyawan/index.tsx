export default function KaryawanIndex({ karyawan }: { karyawan: any[] }) {
    return (
        <div>
            <h1>Karyawan</h1>
            {karyawan.map((item) => (
                <div key={item.id}>{item.nama}</div>
            ))}
        </div>
    )
}