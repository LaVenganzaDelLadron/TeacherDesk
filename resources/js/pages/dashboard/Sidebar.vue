<script setup lang="ts">
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

interface Props {
	activePage: 'dashboard' | 'exams' | 'students' | 'monitoring' | 'announcement' | 'integrity';
}

const props = defineProps<Props>();

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
	{ name: 'Students', href: 'students' },
	{ name: 'Monitoring', href: 'monitoring' },
	{ name: 'Announcement', href: 'announcement' },
	{ name: 'Integrity', href: 'integrity' },
];
</script>

<template>
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
						:class="[
							'flex items-center p-2 rounded-lg transition',
							item.href === activePage ? 'text-cyan-400 bg-[#1a1f33]' : 'text-gray-300 hover:text-cyan-400 hover:bg-[#1a1f33]'
						]"
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
</template>
