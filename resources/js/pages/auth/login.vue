<script setup lang="ts">
import { computed } from 'vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import SuccessAlert from '../components/auth_notif/success_alert.vue';
import WrongAlert from '../components/auth_notif/wrong_alert.vue';

const form = useForm({
	email: '',
	password: '',
	remember: false,
});

const page = usePage();
const successMessage = computed(() => (page.props.flash as Record<string, unknown> | undefined)?.success as string || '');
const errorMessage = computed(() => (page.props.flash as Record<string, unknown> | undefined)?.error as string || '');

const submit = () => {
	form.post('/login', {
		onFinish: () => form.reset('password'),
	});
};
</script>

<template>
	<Head title="Login" />
	<SuccessAlert v-if="successMessage" :message="successMessage" />
	<WrongAlert v-if="errorMessage" :message="errorMessage" />
	<div class="min-h-screen bg-gradient-to-b from-[#070c18] via-[#0a1328] to-[#0f1f3c] text-slate-100" style="--accent:#1dd3f8;--muted:#9fb2d0;">
		<div class="pointer-events-none absolute inset-0 opacity-30" aria-hidden="true">
			<div class="absolute left-1/2 top-0 h-[26rem] w-[26rem] -translate-x-1/2 rounded-full bg-[radial-gradient(circle_at_center,rgba(29,211,248,0.18),transparent_60%)] blur-3xl" />
		</div>

		<div class="relative mx-auto flex min-h-screen max-w-6xl items-center justify-center px-6 py-12">
			<div class="w-full max-w-md rounded-2xl border border-white/10 bg-white/5 p-8 shadow-2xl shadow-black/40 backdrop-blur">
				<div class="mb-6 space-y-2 text-center">
					<p class="text-xs font-semibold uppercase tracking-[0.28em] text-[var(--muted)]">TeacherDesk</p>
					<h1 class="text-2xl font-semibold text-white">Welcome Back</h1>
					<p class="text-sm text-slate-300">Secure access to your monitoring console.</p>
				</div>

				<form class="space-y-4" @submit.prevent="submit">
					<div class="space-y-2">
						<label class="text-xs font-semibold text-slate-200" for="email">Email</label>
						<input
							id="email"
							v-model="form.email"
							type="email"
							class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white shadow-inner shadow-black/30 outline-none transition focus:border-[var(--accent)]/70 focus:ring-2 focus:ring-[var(--accent)]/30"
							placeholder="you@school.edu"
							required
							autocomplete="email"
						/>
						<p v-if="form.errors.email" class="text-xs text-red-400">{{ form.errors.email }}</p>
					</div>

					<div class="space-y-2">
						<label class="text-xs font-semibold text-slate-200" for="password">Password</label>
						<input
							id="password"
							v-model="form.password"
							type="password"
							class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-3 text-sm text-white shadow-inner shadow-black/30 outline-none transition focus:border-[var(--accent)]/70 focus:ring-2 focus:ring-[var(--accent)]/30"
							placeholder="••••••••"
							required
							autocomplete="current-password"
						/>
						<p v-if="form.errors.password" class="text-xs text-red-400">{{ form.errors.password }}</p>
					</div>

					<div class="flex items-center justify-between text-xs text-slate-300">
						<label class="flex items-center gap-2">
							<input v-model="form.remember" type="checkbox" class="h-4 w-4 rounded border-white/20 bg-white/5 text-[var(--accent)] focus:ring-[var(--accent)]" />
							<span>Remember me</span>
						</label>
						<Link class="text-[var(--accent)] transition hover:text-white" href="/forgot-password">Forgot?</Link>
					</div>

					<button
						type="submit"
						:disabled="form.processing"
						class="group inline-flex w-full items-center justify-center gap-2 rounded-lg bg-[var(--accent)] px-4 py-3 text-sm font-semibold text-slate-900 shadow-[0_12px_40px_rgba(29,211,248,0.32)] transition hover:-translate-y-px disabled:cursor-not-allowed disabled:opacity-60"
					>
						<span>Login</span>
						<span class="transition group-hover:translate-x-0.5">→</span>
					</button>
				</form>

				<div class="mt-6 text-center text-xs text-slate-400">
					<span>Need an account?</span>
					<Link class="ml-2 font-semibold text-[var(--accent)] transition hover:text-white" href="/signup">Create one</Link>
				</div>
			</div>
		</div>
	</div>
</template>
