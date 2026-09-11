<div x-data="{
        type: 'slab',
        capacity: 7,
        f: {
            sl_panjang: '',
            sl_lebar: '',
            sl_tebal: '',
            col_diameter: '',
            col_tinggi: '',
            col_jumlah: '',
            bal_lebar: '',
            bal_tinggi: '',
            bal_panjang: '',
            bal_jumlah: '',
            slo_lebar: '',
            slo_tinggi: '',
            slo_panjang: '',
        },
        error: '',
        trucks: null,
        volumeText: '',
        num(v) {
            return parseFloat(String(v ?? '').replace(',', '.'));
        },
        reset() {
            this.error = '';
            this.trucks = null;
            this.volumeText = '';
        },
        calculate() {
            this.error = '';
            this.trucks = null;
            this.volumeText = '';

            const keys = this.type === 'slab'
                ? ['sl_panjang', 'sl_lebar', 'sl_tebal']
                : this.type === 'column'
                    ? ['col_diameter', 'col_tinggi', 'col_jumlah']
                    : this.type === 'beam'
                        ? ['bal_lebar', 'bal_tinggi', 'bal_panjang', 'bal_jumlah']
                        : ['slo_lebar', 'slo_tinggi', 'slo_panjang'];

            const v = {};
            for (const k of keys) {
                const n = this.num(this.f[k]);
                if (!(n > 0)) {
                    this.error = 'Isi semua kolom dengan angka lebih dari 0';
                    return;
                }
                v[k] = n;
            }

            const cap = this.num(this.capacity);
            if (!(cap > 0)) {
                this.error = 'Isi semua kolom dengan angka lebih dari 0';
                return;
            }

            let vol = 0;
            if (this.type === 'slab') {
                vol = v.sl_panjang * v.sl_lebar * v.sl_tebal;
            } else if (this.type === 'column') {
                vol = 0.25 * Math.PI * v.col_diameter * v.col_diameter * v.col_tinggi * v.col_jumlah;
            } else if (this.type === 'beam') {
                vol = v.bal_lebar * v.bal_tinggi * v.bal_panjang * v.bal_jumlah;
            } else {
                vol = v.slo_lebar * v.slo_tinggi * v.slo_panjang;
            }

            this.volumeText = (Math.round(vol * 100) / 100).toFixed(2);
            this.trucks = Math.ceil(vol / cap);
        }
    }"
    @input="reset()"
    @change="reset()"
    class="jkb-reveal rounded-3xl glass p-6 ring-1 ring-white/70 shadow-[0_18px_50px_rgba(15,23,42,0.12)]">

    <div class="flex items-center justify-between border-b border-jkb-gray-light pb-4">
        <div class="flex items-center gap-2">
            <span class="grid h-9 w-9 place-items-center rounded-lg bg-jkb-navy text-jkb-yellow">
                <x-heroicon-m-calculator class="h-5 w-5" />
            </span>
            <span class="text-sm font-bold text-jkb-gray-dark">Kalkulator Estimasi Beton</span>
        </div>
    </div>

    <form class="mt-4 space-y-3" @submit.prevent="calculate()">
        <div>
            <label for="concrete-type" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Jenis Konstruksi</label>
            <select id="concrete-type" name="concrete_type" x-model="type"
                class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-4 py-2.5 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                <option value="slab">Plat/Lantai</option>
                <option value="column">Kolom</option>
                <option value="beam">Balok</option>
                <option value="footing">Sloof/Tapak</option>
            </select>
        </div>

        <template x-if="type === 'slab'">
            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label for="sl-panjang" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Panjang (m)</label>
                    <input id="sl-panjang" type="number" min="0" step="any" inputmode="decimal" placeholder="0" x-model="f.sl_panjang"
                        class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-3 py-2 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                </div>
                <div>
                    <label for="sl-lebar" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Lebar (m)</label>
                    <input id="sl-lebar" type="number" min="0" step="any" inputmode="decimal" placeholder="0" x-model="f.sl_lebar"
                        class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-3 py-2 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                </div>
                <div>
                    <label for="sl-tebal" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Tebal (m)</label>
                    <input id="sl-tebal" type="number" min="0" step="any" inputmode="decimal" placeholder="0" x-model="f.sl_tebal"
                        class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-3 py-2 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                </div>
            </div>
        </template>

        <template x-if="type === 'column'">
            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label for="col-diameter" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Diameter (m)</label>
                    <input id="col-diameter" type="number" min="0" step="any" inputmode="decimal" placeholder="0" x-model="f.col_diameter"
                        class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-3 py-2 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                </div>
                <div>
                    <label for="col-tinggi" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Tinggi (m)</label>
                    <input id="col-tinggi" type="number" min="0" step="any" inputmode="decimal" placeholder="0" x-model="f.col_tinggi"
                        class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-3 py-2 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                </div>
                <div>
                    <label for="col-jumlah" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Jumlah Kolom</label>
                    <input id="col-jumlah" type="number" min="0" step="any" inputmode="numeric" placeholder="0" x-model="f.col_jumlah"
                        class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-3 py-2 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                </div>
            </div>
        </template>

        <template x-if="type === 'beam'">
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="bal-lebar" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Lebar Balok (m)</label>
                    <input id="bal-lebar" type="number" min="0" step="any" inputmode="decimal" placeholder="0" x-model="f.bal_lebar"
                        class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-3 py-2 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                </div>
                <div>
                    <label for="bal-tinggi" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Tinggi Balok (m)</label>
                    <input id="bal-tinggi" type="number" min="0" step="any" inputmode="decimal" placeholder="0" x-model="f.bal_tinggi"
                        class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-3 py-2 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                </div>
                <div>
                    <label for="bal-panjang" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Panjang Balok (m)</label>
                    <input id="bal-panjang" type="number" min="0" step="any" inputmode="decimal" placeholder="0" x-model="f.bal_panjang"
                        class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-3 py-2 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                </div>
                <div>
                    <label for="bal-jumlah" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Jumlah Balok</label>
                    <input id="bal-jumlah" type="number" min="0" step="any" inputmode="numeric" placeholder="0" x-model="f.bal_jumlah"
                        class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-3 py-2 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                </div>
            </div>
        </template>

        <template x-if="type === 'footing'">
            <div class="grid grid-cols-3 gap-3">
                <div>
                    <label for="slo-lebar" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Lebar (m)</label>
                    <input id="slo-lebar" type="number" min="0" step="any" inputmode="decimal" placeholder="0" x-model="f.slo_lebar"
                        class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-3 py-2 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                </div>
                <div>
                    <label for="slo-tinggi" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Tinggi (m)</label>
                    <input id="slo-tinggi" type="number" min="0" step="any" inputmode="decimal" placeholder="0" x-model="f.slo_tinggi"
                        class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-3 py-2 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                </div>
                <div>
                    <label for="slo-panjang" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Panjang Total (m)</label>
                    <input id="slo-panjang" type="number" min="0" step="any" inputmode="decimal" placeholder="0" x-model="f.slo_panjang"
                        class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-3 py-2 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
                </div>
            </div>
        </template>

        <div>
            <label for="concrete-capacity" class="mb-1.5 block text-sm font-semibold text-jkb-gray-dark">Kapasitas Truk Mixer (m³)</label>
            <input id="concrete-capacity" name="capacity" type="number" min="0" step="any" inputmode="decimal" x-model="capacity"
                class="w-full rounded-lg border border-jkb-gray-light bg-jkb-gray-light/40 px-4 py-2.5 text-sm text-jkb-gray-dark outline-none transition-colors focus:border-jkb-yellow-dark focus:bg-white">
        </div>

        <button type="submit"
            class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-jkb-yellow px-6 py-3 text-sm font-bold text-jkb-navy transition-colors hover:bg-jkb-yellow-dark">
            <x-heroicon-m-calculator class="h-5 w-5" />
            Hitung Volume
        </button>

        <div x-show="error" x-cloak x-transition
            class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600" x-text="error"></div>

        <div x-show="trucks !== null" x-cloak x-transition class="grid grid-cols-2 gap-3">
            <div class="rounded-xl bg-jkb-yellow p-4 text-center ring-1 ring-jkb-yellow/50">
                <div class="text-xl font-black text-jkb-navy" x-text="volumeText">0.00</div>
                <div class="mt-0.5 text-[0.7rem] font-bold uppercase tracking-wide text-jkb-navy/70">Volume Beton (m³)</div>
            </div>
            <div class="rounded-xl bg-jkb-navy p-4 text-center ring-1 ring-white/10">
                <div class="text-xl font-black text-jkb-yellow" x-text="trucks">0</div>
                <div class="mt-0.5 text-[0.7rem] font-bold uppercase tracking-wide text-white/70">Truk Mixer Dibutuhkan</div>
            </div>
        </div>
    </form>
</div>