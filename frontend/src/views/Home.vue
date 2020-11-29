<template>
	<div class="container">
		<div class="d-block my-3">
			<label>Pilih Kelas</label>
			<div class="d-block">
				<button class="btn btn-kelas mx-2 my-1" v-for="(item, index) in list.kelas" :key="index" v-on:click="selectKelas(item[0])" :class="select.kelas == item[0] ? 'active' : ''">
					{{ 'Kelas ' + item[0] }}
				</button>
			</div>
		</div>
		<div class="d-block my-3">
			<label>Pilih Jurusan</label>
			<div class="d-block">
				<button class="btn btn-kelas mx-2 my-1" v-for="(item, index) in list.jurusan" :key="index" v-on:click="selectJurusan(item[0])" :class="select.jurusan == item[0] ? 'active' : ''">
					{{ item[1]}}
				</button>
			</div>
		</div>
		<div class="d-block my-3">
			<label>Pilih Pelajaran</label>
			<div class="d-block" v-if="list.pelajaran != null">
				<button class="btn btn-kelas mx-2 my-1" v-for="item in list.pelajaran.data" :key="item.id" v-on:click="selectPelajaran(item.id)" :class="select.pelajaran == item.id ? 'active' : ''">
					{{ item.name }}
				</button>
			</div>
		</div>

		<div class="d-block my-4">
			<label>Daftar Modul</label>

			<div class="row" v-if="list.modul != null">
				<div class="col-4" v-for="modul in list.modul.data" :key="modul.id">
					<div class="card">
						<div class="card-header">
							<span class="card-title">
								{{ modul.name }}
							</span>
						</div>
						<div class="card-body">
							<p class="card-text">
								Total Materi : {{ modul.materis_count }}
							</p>
							<p class="card-text">
								Total Tes : {{ modul.tesses_count }}
							</p>
							<p class="card-text">
								Total Quiz : {{ modul.quizes_count }}
							</p>
						</div>
						<div class="card-footer clearfix">
							<router-link class="btn btn-sm btn-primary float-right" :to="`/modul/${modul.id}`">Join</router-link>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data: () => ({
			list: {
				kelas: [
					[10],
					[11],
					[12]
				],
				jurusan: [
					['rpl', 'Rekayasa Perangkat Lunak'],
					['tkj', 'Teknik Komputer dan Jaringan'],
					['bdp', 'Bisnis Daring dan Pemasaran']
				],
				pelajaran: null,
				modul: null
			},
			select: {
				kelas: null,
				jurusan: null,
				pelajaran: null
			}
		}),
		mounted() {
			this.getModul()
			this.getPelajaran()
		},
		methods: {
			getPelajaran() {
				this.$store.dispatch('getPelajaran')
				.then(response => {
					this.list.pelajaran = response.data
				})
			},
			getModul() {
				this.$store.dispatch('getModul')
				.then(response => {
					this.list.modul = response.data
				})
			},
			selectKelas(kelas) {
				this.select.kelas = kelas
			},
			selectJurusan(jurusan) {
				this.select.jurusan = jurusan
			},
			selectPelajaran(pelajaran) {
				this.select.pelajaran = pelajaran
			},
		}
	}
</script>

<style>
	.btn-kelas:hover {
		background-color: black;
		color: white;
	}

	.btn-kelas.active {
		background-color: black;
		color: white;
	}
</style>