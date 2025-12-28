<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Home from './dashboard/Home/Home.vue';
import Sidebar from './dashboard/Sidebar.vue';
</script>

<template>
	<Head title="Dashboard" />
	<div class="flex h-screen overflow-hidden bg-gradient-to-b from-[#070c18] via-[#0a1328] to-[#0f1f3c] text-slate-100">
		<Sidebar activePage="dashboard" />

		<!-- Main Content - Scrollable -->
		<div class="flex-1 overflow-y-auto bg-gradient-to-b from-[#070c18] via-[#0a1328] to-[#0f1f3c]">
			<div class="pointer-events-none absolute inset-0 opacity-30" aria-hidden="true">
				<div class="absolute right-1/3 top-0 h-[26rem] w-[26rem] rounded-full bg-[radial-gradient(circle_at_center,rgba(29,211,248,0.18),transparent_60%)] blur-3xl" />
			</div>

			<Home />
		</div>
	</div>
</template>
