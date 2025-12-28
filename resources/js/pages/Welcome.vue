<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

const features = [
    { title: 'Live Screen Monitoring', copy: 'Real-time visibility into student sessions with instant status changes and alerts.' },
    { title: 'Cheating Detection', copy: 'Detects tab switches, idle time, and suspicious behaviors so you can respond immediately.' },
    { title: 'Exam Control', copy: 'Lockdown-ready exams with timed sessions, restrictions, and centralized supervision.' },
    { title: 'Security by Design', copy: 'Audited access, encrypted data in transit, and controls tailored for institutions.' },
];
</script>

<template>
    <Head title="TeacherDesk" />
    <div class="min-h-screen bg-slate-950 text-slate-100" style="--navy:#0a1328;--ink:#070c18;--accent:#1dd3f8;--muted:#9fb2d0;">
        <div class="relative overflow-hidden bg-gradient-to-b from-[var(--ink)] via-slate-950 to-[var(--navy)]">
            <div class="pointer-events-none absolute inset-0 opacity-40" aria-hidden="true">
                <div class="absolute left-1/2 top-0 h-[28rem] w-[28rem] -translate-x-1/2 rounded-full bg-[radial-gradient(circle_at_center,rgba(29,211,248,0.22),transparent_60%)] blur-3xl" />
            </div>

            <header class="mx-auto flex max-w-6xl items-center justify-between px-6 py-6">
                <div class="flex items-center gap-2 text-sm font-semibold tracking-[0.16em] text-white/80">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-white/5 ring-1 ring-white/10">TD</span>
                    <span>TeacherDesk</span>
                </div>
                <nav class="hidden items-center gap-6 text-xs font-semibold text-[var(--muted)] md:flex">
                    <a class="transition hover:text-white" href="#features">Features</a>
                    <a class="transition hover:text-white" href="#security">Security</a>
                    <Link class="rounded-full bg-white/5 px-4 py-2 text-white shadow-sm ring-1 ring-white/10 transition hover:-translate-y-px hover:bg-white/10" href="/login">Login</Link>
                </nav>
            </header>

            <section class="mx-auto flex max-w-6xl flex-col gap-10 px-6 pb-20 pt-10 md:flex-row md:items-center md:justify-between">
                <div class="max-w-xl space-y-5">
                    <p class="text-xs font-semibold uppercase tracking-[0.28em] text-[var(--muted)]">Secure. Monitored. Authorized.</p>
                    <h1 class="text-4xl font-semibold leading-tight text-white md:text-5xl">Enterprise-grade oversight for digital classrooms.</h1>
                    <p class="text-base text-slate-300">
                        TeacherDesk delivers secure, real-time monitoring with clear controls for institutions that need confidence, compliance, and calm oversight.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <Link class="rounded-lg bg-[var(--accent)] px-5 py-3 text-sm font-semibold text-slate-900 shadow-[0_10px_40px_rgba(29,211,248,0.25)] transition hover:-translate-y-px" href="/signup">Get Started</Link>
                        <Link class="rounded-lg border border-white/20 px-5 py-3 text-sm font-semibold text-white/90 transition hover:-translate-y-px hover:bg-white/5" href="/login">Admin Login</Link>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="relative overflow-hidden rounded-2xl border border-white/10 bg-white/5 p-6 shadow-xl shadow-black/30">
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(29,211,248,0.12),transparent_35%),radial-gradient(circle_at_80%_10%,rgba(255,255,255,0.08),transparent_30%)]" aria-hidden="true" />
                        <div class="relative space-y-3 text-sm text-slate-200">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--muted)]">Live oversight</p>
                            <div class="rounded-lg border border-white/10 bg-white/5 p-4">
                                <div class="flex items-center justify-between text-xs text-slate-300">
                                    <span>Active Sessions</span>
                                    <span class="rounded-full bg-[var(--accent)]/20 px-3 py-1 font-semibold text-[var(--accent)]">Secure</span>
                                </div>
                                <div class="mt-3 grid grid-cols-3 gap-3 text-[10px] text-slate-300">
                                    <div class="rounded-md bg-white/5 p-3 ring-1 ring-white/10">
                                        <p class="text-[var(--muted)]">Monitoring</p>
                                        <p class="mt-1 text-lg font-semibold text-white">24</p>
                                    </div>
                                    <div class="rounded-md bg-white/5 p-3 ring-1 ring-white/10">
                                        <p class="text-[var(--muted)]">Alerts</p>
                                        <p class="mt-1 text-lg font-semibold text-white">3</p>
                                    </div>
                                    <div class="rounded-md bg-white/5 p-3 ring-1 ring-white/10">
                                        <p class="text-[var(--muted)]">Exams</p>
                                        <p class="mt-1 text-lg font-semibold text-white">12</p>
                                    </div>
                                </div>
                            </div>
                            <div class="rounded-lg border border-white/10 bg-white/5 p-4">
                                <div class="flex items-center justify-between text-xs text-slate-300">
                                    <span>Cheating Detection</span>
                                    <span class="text-[var(--accent)]">Live</span>
                                </div>
                                <div class="mt-2 space-y-2 text-[10px]">
                                    <div class="flex items-center justify-between rounded-md bg-white/5 px-3 py-2 text-slate-200 ring-1 ring-white/10">
                                        <span>Tab switches</span>
                                        <span class="rounded-full bg-[var(--accent)]/15 px-2 py-0.5 text-[var(--accent)]">Flagged</span>
                                    </div>
                                    <div class="flex items-center justify-between rounded-md bg-white/5 px-3 py-2 text-slate-200 ring-1 ring-white/10">
                                        <span>Idle time</span>
                                        <span class="text-[var(--muted)]">Normal</span>
                                    </div>
                                    <div class="flex items-center justify-between rounded-md bg-white/5 px-3 py-2 text-slate-200 ring-1 ring-white/10">
                                        <span>Access violations</span>
                                        <span class="text-[var(--muted)]">None</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section id="features" class="mx-auto max-w-6xl px-6 py-16">
            <div class="mb-8 max-w-3xl space-y-2">
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-[var(--muted)]">Core functions</p>
                <h2 class="text-2xl font-semibold text-white">Built for supervision and integrity</h2>
                <p class="text-sm text-slate-300">Clear, transparent controls for institutions that need accountability, speed, and calm oversight.</p>
            </div>
            <div class="grid gap-6 md:grid-cols-2">
                <article v-for="feature in features" :key="feature.title" class="rounded-2xl border border-white/10 bg-white/5 p-6 shadow-lg shadow-black/20 transition hover:-translate-y-1 hover:border-[var(--accent)]/40 hover:shadow-[0_20px_60px_rgba(0,0,0,0.35)]">
                    <div class="mb-3 flex items-center gap-2 text-[var(--accent)]">
                        <span class="h-2 w-2 rounded-full bg-[var(--accent)]" />
                        <h3 class="text-lg font-semibold text-white">{{ feature.title }}</h3>
                    </div>
                    <p class="text-sm text-slate-200">{{ feature.copy }}</p>
                </article>
            </div>
        </section>

        <section id="security" class="border-y border-white/10 bg-white/5">
            <div class="mx-auto max-w-6xl px-6 py-12">
                <div class="grid gap-10 md:grid-cols-[1.3fr_1fr] md:items-center">
                    <div class="space-y-3">
                        <p class="text-xs font-semibold uppercase tracking-[0.28em] text-[var(--muted)]">Security & privacy</p>
                        <h3 class="text-xl font-semibold text-white">Authorized use with explicit consent.</h3>
                        <p class="text-sm text-slate-200">TeacherDesk is purpose-built for schools and institutions. Monitoring runs only for authorized accounts, with activity recorded for compliance and oversight. Transparent consent, audited access, and protected data flows keep stakeholders informed and secure.</p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-slate-950/60 p-6 text-sm text-slate-200 shadow-xl shadow-black/30">
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <span class="mt-1 h-2 w-2 rounded-full bg-[var(--accent)]" />
                                <div>
                                    <p class="font-semibold text-white">Consent-first monitoring</p>
                                    <p class="text-xs text-slate-300">Runs with institutional approval and documented consent for every session.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 h-2 w-2 rounded-full bg-[var(--accent)]" />
                                <div>
                                    <p class="font-semibold text-white">Encrypted and audited</p>
                                    <p class="text-xs text-slate-300">Data in transit is encrypted, and access is logged for accountability.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="mt-1 h-2 w-2 rounded-full bg-[var(--accent)]" />
                                <div>
                                    <p class="font-semibold text-white">Institution-ready controls</p>
                                    <p class="text-xs text-slate-300">Role-based access, session controls, and alerts align with school policies.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <footer id="access" class="border-t border-white/10 bg-slate-950/80">
            <div class="mx-auto flex max-w-6xl flex-col gap-4 px-6 py-8 text-sm text-slate-300 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="font-semibold text-white">TeacherDesk</p>
                    <p class="text-xs text-[var(--muted)]">Copyright © {{ new Date().getFullYear() }} · Institutional use only</p>
                </div>
                <div class="flex flex-wrap items-center gap-3">
                    <Link class="rounded-lg bg-[var(--accent)] px-4 py-2 text-slate-900 font-semibold text-xs shadow-[0_10px_30px_rgba(29,211,248,0.25)] transition hover:-translate-y-px" href="/login">Access Dashboard</Link>
                    <span class="text-xs text-[var(--muted)]">Secure. Monitored. Academic.</span>
                </div>
            </div>
        </footer>
    </div>
</template>
