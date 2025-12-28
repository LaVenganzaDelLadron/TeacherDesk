<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

interface Announcement {
	id: number;
	title: string;
	message: string;
	author: string;
	timestamp: string;
	tag: 'urgent' | 'exam' | 'general';
	visibility: string;
}

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

const announcements = ref<Announcement[]>([
	{
		id: 1,
		title: 'Final Exam Schedule Released',
		message: 'The final examination schedule has been published. Please check your exam dates and times carefully. All exams will be conducted online through the TeacherDesk platform.',
		author: 'Prof. Alex',
		timestamp: '2 hours ago',
		tag: 'exam',
		visibility: 'All Students',
	},
	{
		id: 2,
		title: 'System Maintenance Notice',
		message: 'The TeacherDesk platform will undergo scheduled maintenance on December 30th from 2:00 AM to 4:00 AM. Please save all your work before this time.',
		author: 'Admin Team',
		timestamp: '5 hours ago',
		tag: 'urgent',
		visibility: 'All Students',
	},
	{
		id: 3,
		title: 'New Study Materials Available',
		message: 'New study materials for Chemistry and Physics have been uploaded to the resource center. Students are encouraged to review them before the upcoming exams.',
		author: 'Prof. Sarah',
		timestamp: '1 day ago',
		tag: 'general',
		visibility: 'Chemistry & Physics Students',
	},
	{
		id: 4,
		title: 'Exam Guidelines Reminder',
		message: 'Please ensure you have a stable internet connection and your device is fully charged before starting any exam. No external resources are allowed during examination.',
		author: 'Prof. Alex',
		timestamp: '2 days ago',
		tag: 'exam',
		visibility: 'All Students',
	},
	{
		id: 5,
		title: 'Holiday Break Schedule',
		message: 'Classes will resume on January 5th, 2026 after the winter break. Wishing all students a relaxing and productive holiday season.',
		author: 'Administration',
		timestamp: '3 days ago',
		tag: 'general',
		visibility: 'All Students',
	},
]);

const showNewAnnouncementModal = ref(false);

const getTagColor = (tag: Announcement['tag']) => {
	const colors = {
		urgent: 'bg-rose-500/20 text-rose-300 border-rose-500/40',
		exam: 'bg-amber-500/20 text-amber-300 border-amber-500/40',
		general: 'bg-cyan-500/20 text-cyan-300 border-cyan-500/40',
	};
	return colors[tag];
};

const createAnnouncement = () => {
	showNewAnnouncementModal.value = true;
};

const editAnnouncement = (id: number) => {
	console.log('Edit announcement:', id);
};

const archiveAnnouncement = (id: number) => {
	if (confirm('Archive this announcement?')) {
		announcements.value = announcements.value.filter((a) => a.id !== id);
	}
};

const deleteAnnouncement = (id: number) => {
	if (confirm('Are you sure you want to delete this announcement?')) {
		announcements.value = announcements.value.filter((a) => a.id !== id);
	}
};
</script>

<template>
	<Head title="Announcements" />
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
							:class="[
								'flex items-center p-2 rounded-lg transition',
								item.href === 'announcement' ? 'text-cyan-400 bg-[#1a1f33]' : 'text-gray-300 hover:text-cyan-400 hover:bg-[#1a1f33]'
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

		<!-- Main Content - Scrollable -->
		<div class="flex-1 overflow-y-auto bg-gradient-to-b from-[#070c18] via-[#0a1328] to-[#0f1f3c]">
			<div class="pointer-events-none absolute inset-0 opacity-30" aria-hidden="true">
				<div class="absolute right-1/3 top-0 h-[26rem] w-[26rem] rounded-full bg-[radial-gradient(circle_at_center,rgba(29,211,248,0.18),transparent_60%)] blur-3xl" />
			</div>

			<div class="relative p-8">
				<!-- Header -->
				<div class="mb-8 flex items-center justify-between">
					<div>
						<h1 class="text-3xl font-semibold text-white">Announcements</h1>
						<p class="mt-2 text-slate-400">Broadcast important updates and information to your students</p>
					</div>
					<button
						@click="createAnnouncement"
						class="flex items-center gap-2 bg-cyan-500 hover:bg-cyan-600 text-slate-900 font-semibold px-6 py-3 rounded-lg shadow-lg shadow-cyan-500/30 transition hover:-translate-y-0.5"
					>
						<span class="text-lg">+</span>
						<span>New Announcement</span>
					</button>
				</div>

				<!-- Announcements Cards -->
				<div class="space-y-6">
					<div
						v-for="announcement in announcements"
						:key="announcement.id"
						class="group bg-[#121826] border border-white/10 rounded-xl p-6 hover:bg-[#1a1f33] transition"
					>
						<div class="flex items-start justify-between mb-4">
							<div class="flex-1">
								<div class="flex items-center gap-3 mb-2">
									<h3 class="text-lg font-semibold text-white">{{ announcement.title }}</h3>
									<span :class="['inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold border', getTagColor(announcement.tag)]">
										{{ announcement.tag.charAt(0).toUpperCase() + announcement.tag.slice(1) }}
									</span>
								</div>
								<p class="text-sm text-slate-300 leading-relaxed line-clamp-2">{{ announcement.message }}</p>
							</div>

							<!-- Action Buttons - Visible on Hover -->
							<div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition ml-4">
								<button
									@click="editAnnouncement(announcement.id)"
									class="p-2 text-slate-400 hover:text-cyan-400 hover:bg-cyan-400/10 rounded-lg transition"
									title="Edit"
								>
									<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
									</svg>
								</button>
								<button
									@click="archiveAnnouncement(announcement.id)"
									class="p-2 text-slate-400 hover:text-amber-400 hover:bg-amber-400/10 rounded-lg transition"
									title="Archive"
								>
									<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
									</svg>
								</button>
								<button
									@click="deleteAnnouncement(announcement.id)"
									class="p-2 text-slate-400 hover:text-rose-400 hover:bg-rose-400/10 rounded-lg transition"
									title="Delete"
								>
									<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
									</svg>
								</button>
							</div>
						</div>

						<div class="flex items-center justify-between pt-4 border-t border-white/10">
							<div class="flex items-center gap-4 text-sm text-slate-400">
								<span class="flex items-center gap-2">
									<span class="w-6 h-6 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-300 text-xs font-semibold">
										{{ announcement.author.charAt(0) }}
									</span>
									{{ announcement.author }}
								</span>
								<span>•</span>
								<span>{{ announcement.timestamp }}</span>
							</div>
							<div class="text-sm text-slate-500">
								<span class="flex items-center gap-1">
									<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
									</svg>
									{{ announcement.visibility }}
								</span>
							</div>
						</div>
					</div>
				</div>

				<!-- Empty State -->
				<div v-if="announcements.length === 0" class="bg-[#121826] border border-white/10 rounded-xl p-16 text-center">
					<div class="text-slate-500 mb-4">
						<svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
						</svg>
					</div>
					<p class="text-slate-400">No announcements yet</p>
					<p class="text-slate-500 text-sm mt-2">Create your first announcement to get started</p>
				</div>
			</div>
		</div>
	</div>
</template>

<style scoped>
/* Scrollbar styling */
::-webkit-scrollbar {
	width: 6px;
	height: 6px;
}

::-webkit-scrollbar-track {
	background: transparent;
}

::-webkit-scrollbar-thumb {
	background: rgba(29, 211, 248, 0.2);
	border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
	background: rgba(29, 211, 248, 0.3);
}

/* Truncate text to 2 lines */
.line-clamp-2 {
	display: -webkit-box;
	-webkit-line-clamp: 2;
	-webkit-box-orient: vertical;
	overflow: hidden;
}
</style>
