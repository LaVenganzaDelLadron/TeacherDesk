<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Home from './dashboard/Home/Home.vue';

const page = usePage();
const auth = computed(() => page.props.auth as { user: { name: string; email: string } } | undefined);
const user = auth.value?.user;

const getInitials = (name: string) => {
	return name
		.split(' ')
		.map((n) => n[0])
		.join('')
		.toUpperCase()
		.slice(0, 2);
};

const menuItems = [
	{ name: 'Dashboard', href: 'dashboard' },
	{ name: 'Exams', href: 'exams' },
	{ name: 'Monitoring', href: 'monitoring' },
	{ name: 'Announcement', href: 'announcement' },
	{ name: 'Students', href: 'students' },
	{ name: 'Integrity', href: 'integrity' },
];
</script>

<template>
	<Head title="Dashboard" />
	<div class="flex h-screen overflow-hidden bg-gradient-to-b from-[#070c18] via-[#0a1328] to-[#0f1f3c] text-slate-100">
		<!-- Sidebar - Fixed -->
		<aside class="w-64 bg-[#121826] h-screen p-6 flex flex-col justify-between border-r border-white/10 flex-shrink-0">
			<!-- Logo / Title -->
			<div class="mb-10">
				<h1 class="text-2xl font-bold text-cyan-400">TEACHER DESK</h1>
			</div>

			<!-- Menu -->
			<nav class="flex-1 overflow-y-auto">
				<ul class="space-y-4">
					<li v-for="item in menuItems" :key="item.name">
						<Link
							:href="`/${item.href}`"
							class="flex items-center p-2 rounded-lg text-gray-300 hover:text-cyan-400 hover:bg-[#1a1f33] transition"
						>
							{{ item.name }}
						</Link>
					</li>
				</ul>
			</nav>

			<!-- User Section -->
			<div class="mt-10">
				<div class="flex items-center space-x-3 mb-4">
					<div class="w-10 h-10 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-300 font-semibold">
						{{ user ? getInitials(user.name) : 'U' }}
					</div>
					<div class="flex-1 min-w-0">
						<p class="text-gray-200 font-semibold truncate">{{ user?.name || 'User' }}</p>
						<p class="text-gray-400 text-sm truncate">{{ user?.email || 'user@example.com' }}</p>
					</div>
				</div>
				<Link
					href="/logout"
					method="post"
					as="button"
					class="w-full rounded-lg bg-red-500/20 px-3 py-2 text-sm font-semibold text-red-300 transition hover:bg-red-500/30"
				>
					Logout
				</Link>
			</div>
		</aside>

		<!-- Main Content - Scrollable -->
		<div class="flex-1 overflow-y-auto bg-gradient-to-b from-[#070c18] via-[#0a1328] to-[#0f1f3c]">
			<div class="pointer-events-none absolute inset-0 opacity-30" aria-hidden="true">
				<div class="absolute right-1/3 top-0 h-[26rem] w-[26rem] rounded-full bg-[radial-gradient(circle_at_center,rgba(29,211,248,0.18),transparent_60%)] blur-3xl" />
			</div>

			<Home />
		</div>
	</div>
</template>
