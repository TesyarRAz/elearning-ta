<template>
	<div class="container">
		<label>Modul : {{ modul.name }}</label>
	</div>
</template>

<script>
	export default {
		data: () => ({
			modul: {}
		}),
		mounted() {
			this.getModul()
		},
		methods: {
			getModul() {
				this.$store.dispatch('getModulById', this.$route.params.id)
				.then(response => {
					this.modul = response.data

					console.log(response.data.data)
				})
			}
		}
	}
</script>