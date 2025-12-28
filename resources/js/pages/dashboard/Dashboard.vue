<script setup lang="ts">
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import SuccessAlert from '../components/auth_notif/success_alert.vue';
import WrongAlert from '../components/auth_notif/wrong_alert.vue';

const navItems = [
	{ label: 'Dashboard', href: '/dashboard', key: 'dashboard' },
	{ label: 'Exams', href: '/exams', key: 'exams' },
	{ label: 'Monitoring', href: '/monitoring', key: 'monitoring' },
	{ label: 'Announcement', href: '/announcements', key: 'announcement' },
	{ label: 'Students', href: '/students', key: 'students' },
	{ label: 'Integrity', href: '/integrity', key: 'integrity' },
];

// In a real app, determine this from the current route
const activeKey = 'dashboard';

const page = usePage();
const successMessage = computed(() => (page.props.flash as Record<string, unknown> | undefined)?.success as string || '');
const errorMessage = computed(() => (page.props.flash as Record<string, unknown> | undefined)?.error as string || '');
</script>

<template>
	<div class="min-h-screen bg-slate-950 text-slate-100" style="--accent:#1dd3f8;--muted:#9fb2d0;">
		<SuccessAlert v-if="successMessage" :message="successMessage" />
		<WrongAlert v-if="errorMessage" :message="errorMessage" />
		<div class="flex">
			<aside class="sticky top-0 h-screen w-64 shrink-0 overflow-y-auto border-r border-white/10 bg-gradient-to-b from-[#0b1426] via-[#0c1a32] to-[#0b1426] shadow-xl shadow-black/40">
				<div class="flex h-full flex-col">
					<div class="px-5 pb-6 pt-6">
						<div class="inline-flex items-center gap-2 rounded-lg bg-white/5 px-3 py-2 text-xs font-semibold tracking-[0.24em] text-[var(--accent)] ring-1 ring-[var(--accent)]/30">
							TEACHER DESK
						</div>
					</div>

					<nav class="flex-1 space-y-1 px-3">
						<ul class="space-y-1 text-sm font-semibold text-slate-300">
							<li v-for="item in navItems" :key="item.key">
								<Link
									:href="item.href"
									class="group relative flex items-center gap-2 rounded-lg px-3 py-2 transition"
									:class="activeKey === item.key ? 'bg-white/5 text-white' : 'hover:bg-white/5 hover:text-white'"
								>
									<span
										class="absolute left-0 top-1/2 h-7 w-1 -translate-y-1/2 rounded-full bg-[var(--accent)] transition"
										:class="activeKey === item.key ? 'opacity-100' : 'opacity-0 group-hover:opacity-60'"
									/>
									<span class="ml-2">{{ item.label }}</span>
								</Link>
							</li>
						</ul>
					</nav>

					<div class="mt-auto border-t border-white/10 px-4 py-4">
						<div class="flex items-center gap-3 rounded-lg bg-white/5 px-3 py-3 text-sm shadow-inner shadow-black/30">
							<div class="flex h-9 w-9 items-center justify-center rounded-full bg-[var(--accent)]/15 text-[var(--accent)] ring-1 ring-[var(--accent)]/30">
								A
							</div>
							<div class="leading-tight">
								<p class="text-xs font-semibold text-white">Prof. Alex</p>
								<p class="text-[11px] text-[var(--muted)]">Administrator</p>
							</div>
						</div>
					</div>
				</div>
			</aside>

			<main class="flex-1 px-8 py-10">
				<div class="rounded-2xl border border-white/10 bg-white/5 p-6 shadow-xl shadow-black/30">
					<h1 class="text-2xl font-semibold text-white">Dashboard</h1>
					<p class="mt-2 text-sm text-slate-300">Main content area goes here.</p>
				</div>
			</main>
		</div>
	</div>
</template>
