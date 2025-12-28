<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import Sidebar from '../Sidebar.vue';

interface Violation {
	id: number;
	studentName: string;
	studentId: string;
	violationType: 'tab-switch' | 'unauthorized-app' | 'multiple-screens' | 'suspicious-inactivity' | 'copy-paste' | 'external-device';
	timestamp: string;
	examName: string;
	riskLevel: 'low' | 'medium' | 'high' | 'critical';
	evidenceAvailable: {
		screenshot: boolean;
		log: boolean;
		video: boolean;
	};
	status: 'pending' | 'reviewed' | 'cleared' | 'escalated';
}

interface StudentTrustScore {
	id: number;
	name: string;
	studentId: string;
	trustScore: number;
	violations: number;
	lastIncident: string;
	status: 'good' | 'warning' | 'critical';
}

// Mock violation data
const violations = ref<Violation[]>([
	{
		id: 1,
		studentName: 'Michael Chen',
		studentId: 'STU-2024-003',
		violationType: 'unauthorized-app',
		timestamp: '2025-12-28 09:45:23',
		examName: 'Mathematics Final',
		riskLevel: 'critical',
		evidenceAvailable: { screenshot: true, log: true, video: true },
		status: 'pending'
	},
	{
		id: 2,
		studentName: 'Alex Brown',
		studentId: 'STU-2024-005',
		violationType: 'tab-switch',
		timestamp: '2025-12-28 09:42:08',
		examName: 'Mathematics Final',
		riskLevel: 'high',
		evidenceAvailable: { screenshot: true, log: true, video: false },
		status: 'pending'
	},
	{
		id: 3,
		studentName: 'Robert Taylor',
		studentId: 'STU-2024-007',
		violationType: 'copy-paste',
		timestamp: '2025-12-28 09:38:15',
		examName: 'Chemistry Quiz',
		riskLevel: 'high',
		evidenceAvailable: { screenshot: false, log: true, video: false },
		status: 'reviewed'
	},
	{
		id: 4,
		studentName: 'Jane Smith',
		studentId: 'STU-2024-002',
		violationType: 'multiple-screens',
		timestamp: '2025-12-28 09:30:44',
		examName: 'Physics Midterm',
		riskLevel: 'medium',
		evidenceAvailable: { screenshot: true, log: true, video: false },
		status: 'pending'
	},
	{
		id: 5,
		studentName: 'David Kim',
		studentId: 'STU-2024-005',
		violationType: 'suspicious-inactivity',
		timestamp: '2025-12-28 09:25:12',
		examName: 'Mathematics Final',
		riskLevel: 'low',
		evidenceAvailable: { screenshot: false, log: true, video: false },
		status: 'cleared'
	},
	{
		id: 6,
		studentName: 'Chris Wilson',
		studentId: 'STU-2024-007',
		violationType: 'external-device',
		timestamp: '2025-12-28 09:20:33',
		examName: 'Chemistry Quiz',
		riskLevel: 'critical',
		evidenceAvailable: { screenshot: true, log: true, video: true },
		status: 'escalated'
	}
]);

// Mock trust score data
const trustScores = ref<StudentTrustScore[]>([
	{ id: 1, name: 'John Anderson', studentId: 'STU-2024-001', trustScore: 100, violations: 0, lastIncident: 'Never', status: 'good' },
	{ id: 2, name: 'Sarah Martinez', studentId: 'STU-2024-002', trustScore: 95, violations: 0, lastIncident: 'Never', status: 'good' },
	{ id: 3, name: 'Michael Chen', studentId: 'STU-2024-003', trustScore: 45, violations: 3, lastIncident: '5 min ago', status: 'critical' },
	{ id: 4, name: 'Emily Johnson', studentId: 'STU-2024-004', trustScore: 100, violations: 0, lastIncident: 'Never', status: 'good' },
	{ id: 5, name: 'Alex Brown', studentId: 'STU-2024-005', trustScore: 65, violations: 2, lastIncident: '18 min ago', status: 'warning' },
	{ id: 6, name: 'Jessica Brown', studentId: 'STU-2024-006', trustScore: 100, violations: 0, lastIncident: 'Never', status: 'good' },
	{ id: 7, name: 'Robert Taylor', studentId: 'STU-2024-007', trustScore: 78, violations: 1, lastIncident: '22 min ago', status: 'warning' },
	{ id: 8, name: 'Amanda Wilson', studentId: 'STU-2024-008', trustScore: 100, violations: 0, lastIncident: 'Never', status: 'good' }
]);

// Computed metrics
const metrics = computed(() => ({
	totalViolations: violations.value.length,
	studentsFlagged: new Set(violations.value.map(v => v.studentId)).size,
	highRiskAlerts: violations.value.filter(v => v.riskLevel === 'critical' || v.riskLevel === 'high').length,
	systemTrustLevel: Math.round(trustScores.value.reduce((sum, s) => sum + s.trustScore, 0) / trustScores.value.length)
}));

// Filter options
const filterRiskLevel = ref<string>('all');
const filterStatus = ref<string>('all');

// Filtered violations
const filteredViolations = computed(() => {
	return violations.value.filter(v => {
		const riskMatch = filterRiskLevel.value === 'all' || v.riskLevel === filterRiskLevel.value;
		const statusMatch = filterStatus.value === 'all' || v.status === filterStatus.value;
		return riskMatch && statusMatch;
	});
});

// Utility functions
const getRiskLevelColor = (level: string) => {
	const colors = {
		low: 'bg-blue-500/20 text-blue-300 border-blue-500/40',
		medium: 'bg-yellow-500/20 text-yellow-300 border-yellow-500/40',
		high: 'bg-orange-500/20 text-orange-300 border-orange-500/40',
		critical: 'bg-red-500/20 text-red-300 border-red-500/40'
	};
	return colors[level as keyof typeof colors];
};

const getStatusColor = (status: string) => {
	const colors = {
		pending: 'bg-amber-500/20 text-amber-300 border-amber-500/40',
		reviewed: 'bg-blue-500/20 text-blue-300 border-blue-500/40',
		cleared: 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40',
		escalated: 'bg-red-500/20 text-red-300 border-red-500/40'
	};
	return colors[status as keyof typeof colors];
};

const getTrustScoreColor = (score: number) => {
	if (score >= 80) return 'bg-emerald-500';
	if (score >= 60) return 'bg-yellow-500';
	return 'bg-red-500';
};

const getTrustScoreStatus = (status: string) => {
	const colors = {
		good: 'text-emerald-400',
		warning: 'text-yellow-400',
		critical: 'text-red-400'
	};
	return colors[status as keyof typeof colors];
};

const getViolationTypeLabel = (type: string) => {
	const labels = {
		'tab-switch': 'Tab Switching',
		'unauthorized-app': 'Unauthorized App',
		'multiple-screens': 'Multiple Screens',
		'suspicious-inactivity': 'Suspicious Inactivity',
		'copy-paste': 'Copy/Paste Detected',
		'external-device': 'External Device'
	};
	return labels[type as keyof typeof labels] || type;
};

// Actions
const reviewViolation = (violationId: number) => {
	const violation = violations.value.find(v => v.id === violationId);
	if (violation) {
		violation.status = 'reviewed';
		console.log('Review violation:', violationId);
	}
};

const clearViolation = (violationId: number) => {
	if (confirm('Are you sure you want to clear this violation?')) {
		const violation = violations.value.find(v => v.id === violationId);
		if (violation) {
			violation.status = 'cleared';
			console.log('Clear violation:', violationId);
		}
	}
};

const escalateViolation = (violationId: number) => {
	if (confirm('Escalate this violation to administration?')) {
		const violation = violations.value.find(v => v.id === violationId);
		if (violation) {
			violation.status = 'escalated';
			console.log('Escalate violation:', violationId);
		}
	}
};

const viewEvidence = (violationId: number) => {
	console.log('View evidence for violation:', violationId);
	// TODO: Open evidence modal
};
</script>

<template>
	<Head title="Integrity" />
	<div class="flex h-screen overflow-hidden bg-gradient-to-b from-[#070c18] via-[#0a1328] to-[#0f1f3c] text-slate-100">
		<Sidebar activePage="integrity" />

		<!-- Main Content - Scrollable -->
		<div class="flex-1 overflow-y-auto bg-gradient-to-b from-[#070c18] via-[#0a1328] to-[#0f1f3c]">
			<div class="pointer-events-none absolute inset-0 opacity-30" aria-hidden="true">
				<div class="absolute right-1/3 top-0 h-[26rem] w-[26rem] rounded-full bg-[radial-gradient(circle_at_center,rgba(29,211,248,0.18),transparent_60%)] blur-3xl" />
			</div>

			<div class="relative p-8">
				<!-- Header -->
				<div class="mb-8">
					<div class="flex items-center gap-3 mb-2">
						<div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
							<svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
							</svg>
						</div>
						<h1 class="text-3xl font-semibold text-white">Academic Integrity</h1>
					</div>
					<p class="text-slate-400">Monitor violations, review evidence, and maintain exam security standards</p>
				</div>

				<!-- Metrics Cards -->
				<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
					<div class="bg-[#121826] border border-white/10 rounded-xl p-6 hover:bg-[#1a1f33] transition">
						<div class="flex items-center justify-between mb-4">
							<p class="text-slate-400 text-sm font-medium">Total Violations</p>
							<div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
								<svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
								</svg>
							</div>
						</div>
						<p class="text-3xl font-bold text-red-400">{{ metrics.totalViolations }}</p>
						<p class="text-xs text-slate-500 mt-2">Detected incidents</p>
					</div>

					<div class="bg-[#121826] border border-white/10 rounded-xl p-6 hover:bg-[#1a1f33] transition">
						<div class="flex items-center justify-between mb-4">
							<p class="text-slate-400 text-sm font-medium">Students Flagged</p>
							<div class="w-10 h-10 bg-amber-500/20 rounded-lg flex items-center justify-center">
								<svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
								</svg>
							</div>
						</div>
						<p class="text-3xl font-bold text-amber-400">{{ metrics.studentsFlagged }}</p>
						<p class="text-xs text-slate-500 mt-2">Under review</p>
					</div>

					<div class="bg-[#121826] border border-white/10 rounded-xl p-6 hover:bg-[#1a1f33] transition">
						<div class="flex items-center justify-between mb-4">
							<p class="text-slate-400 text-sm font-medium">High-Risk Alerts</p>
							<div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center">
								<svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
								</svg>
							</div>
						</div>
						<p class="text-3xl font-bold text-orange-400">{{ metrics.highRiskAlerts }}</p>
						<p class="text-xs text-slate-500 mt-2">Critical + High severity</p>
					</div>

					<div class="bg-[#121826] border border-white/10 rounded-xl p-6 hover:bg-[#1a1f33] transition">
						<div class="flex items-center justify-between mb-4">
							<p class="text-slate-400 text-sm font-medium">System Trust Level</p>
							<div class="w-10 h-10 bg-cyan-500/20 rounded-lg flex items-center justify-center">
								<svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
								</svg>
							</div>
						</div>
						<p class="text-3xl font-bold text-cyan-400">{{ metrics.systemTrustLevel }}%</p>
						<p class="text-xs text-slate-500 mt-2">Average integrity score</p>
					</div>
				</div>

				<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
					<!-- Violation Log Table -->
					<div class="lg:col-span-2">
						<div class="bg-[#121826] border border-white/10 rounded-xl overflow-hidden">
							<div class="p-6 border-b border-white/10">
								<div class="flex items-center justify-between mb-4">
									<h2 class="text-lg font-semibold text-white">Violation Log</h2>
									<div class="flex items-center gap-3">
										<select v-model="filterRiskLevel" class="bg-[#0a0e1a] border border-gray-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-500">
											<option value="all">All Risk Levels</option>
											<option value="critical">Critical</option>
											<option value="high">High</option>
											<option value="medium">Medium</option>
											<option value="low">Low</option>
										</select>
										<select v-model="filterStatus" class="bg-[#0a0e1a] border border-gray-700 rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-cyan-500">
											<option value="all">All Status</option>
											<option value="pending">Pending</option>
											<option value="reviewed">Reviewed</option>
											<option value="cleared">Cleared</option>
											<option value="escalated">Escalated</option>
										</select>
									</div>
								</div>
							</div>

							<div class="overflow-x-auto">
								<table class="w-full">
									<thead class="bg-white/5 border-b border-white/10">
										<tr>
											<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Student</th>
											<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Violation Type</th>
											<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Exam</th>
											<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Time</th>
											<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Risk</th>
											<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Evidence</th>
											<th class="px-6 py-4 text-left text-xs font-semibold text-slate-400 uppercase tracking-wider">Status</th>
											<th class="px-6 py-4 text-right text-xs font-semibold text-slate-400 uppercase tracking-wider">Actions</th>
										</tr>
									</thead>
									<tbody class="divide-y divide-white/10">
										<tr v-for="violation in filteredViolations" :key="violation.id" class="hover:bg-white/5 transition">
											<td class="px-6 py-4">
												<div>
													<p class="text-sm font-medium text-white">{{ violation.studentName }}</p>
													<p class="text-xs text-slate-400">{{ violation.studentId }}</p>
												</div>
											</td>
											<td class="px-6 py-4">
												<p class="text-sm text-slate-300">{{ getViolationTypeLabel(violation.violationType) }}</p>
											</td>
											<td class="px-6 py-4">
												<p class="text-sm text-slate-400">{{ violation.examName }}</p>
											</td>
											<td class="px-6 py-4">
												<p class="text-xs text-slate-400">{{ violation.timestamp }}</p>
											</td>
											<td class="px-6 py-4">
												<span :class="['inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border uppercase', getRiskLevelColor(violation.riskLevel)]">
													{{ violation.riskLevel }}
												</span>
											</td>
											<td class="px-6 py-4">
												<div class="flex items-center gap-2">
													<button @click="viewEvidence(violation.id)" v-if="violation.evidenceAvailable.screenshot" class="p-1.5 bg-cyan-500/20 text-cyan-400 rounded hover:bg-cyan-500/30 transition" title="Screenshot Available">
														<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
														</svg>
													</button>
													<button @click="viewEvidence(violation.id)" v-if="violation.evidenceAvailable.log" class="p-1.5 bg-blue-500/20 text-blue-400 rounded hover:bg-blue-500/30 transition" title="Log Available">
														<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
														</svg>
													</button>
													<button @click="viewEvidence(violation.id)" v-if="violation.evidenceAvailable.video" class="p-1.5 bg-purple-500/20 text-purple-400 rounded hover:bg-purple-500/30 transition" title="Video Available">
														<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
														</svg>
													</button>
													<span v-if="!violation.evidenceAvailable.screenshot && !violation.evidenceAvailable.log && !violation.evidenceAvailable.video" class="text-xs text-slate-500">None</span>
												</div>
											</td>
											<td class="px-6 py-4">
												<span :class="['inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border capitalize', getStatusColor(violation.status)]">
													{{ violation.status }}
												</span>
											</td>
											<td class="px-6 py-4">
												<div class="flex items-center justify-end gap-2">
													<button v-if="violation.status === 'pending'" @click="reviewViolation(violation.id)" class="p-1.5 text-cyan-400 hover:bg-cyan-500/10 rounded-lg transition" title="Review">
														<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
														</svg>
													</button>
													<button v-if="violation.status !== 'cleared'" @click="clearViolation(violation.id)" class="p-1.5 text-emerald-400 hover:bg-emerald-500/10 rounded-lg transition" title="Clear">
														<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
														</svg>
													</button>
													<button v-if="violation.status !== 'escalated'" @click="escalateViolation(violation.id)" class="p-1.5 text-red-400 hover:bg-red-500/10 rounded-lg transition" title="Escalate">
														<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
														</svg>
													</button>
												</div>
											</td>
										</tr>
									</tbody>
								</table>

								<!-- Empty State -->
								<div v-if="filteredViolations.length === 0" class="py-16 text-center">
									<svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
									</svg>
									<p class="text-slate-400 text-lg font-medium mb-2">No violations found</p>
									<p class="text-slate-500 text-sm">All students are maintaining academic integrity standards</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Trust Score Panel -->
					<div class="lg:col-span-1">
						<div class="bg-[#121826] border border-white/10 rounded-xl p-6 sticky top-8">
							<h3 class="text-lg font-semibold text-white mb-6 flex items-center gap-2">
								<svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
								</svg>
								Student Trust Scores
							</h3>

							<div class="space-y-4 max-h-[600px] overflow-y-auto">
								<div v-for="student in trustScores" :key="student.id" class="bg-white/5 border border-white/10 rounded-lg p-4 hover:bg-white/10 transition">
									<div class="flex items-start justify-between mb-3">
										<div class="flex-1 min-w-0">
											<p class="text-sm font-medium text-white truncate">{{ student.name }}</p>
											<p class="text-xs text-slate-400">{{ student.studentId }}</p>
										</div>
										<span :class="['text-xl font-bold', getTrustScoreStatus(student.status)]">
											{{ student.trustScore }}
										</span>
									</div>

									<div class="mb-3">
										<div class="w-full bg-slate-700/50 rounded-full h-2 overflow-hidden">
											<div 
												:class="['h-full transition-all duration-500', getTrustScoreColor(student.trustScore)]"
												:style="{ width: student.trustScore + '%' }"
											></div>
										</div>
									</div>

									<div class="flex items-center justify-between text-xs">
										<span class="text-slate-400">
											{{ student.violations }} violation{{ student.violations !== 1 ? 's' : '' }}
										</span>
										<span class="text-slate-500">{{ student.lastIncident }}</span>
									</div>
								</div>
							</div>

							<!-- Trust Score Legend -->
							<div class="mt-6 pt-6 border-t border-white/10 space-y-2">
								<p class="text-xs font-semibold text-slate-400 uppercase mb-3">Score Ranges</p>
								<div class="flex items-center gap-2 text-xs">
									<div class="w-3 h-3 bg-emerald-500 rounded"></div>
									<span class="text-slate-300">80-100: Good Standing</span>
								</div>
								<div class="flex items-center gap-2 text-xs">
									<div class="w-3 h-3 bg-yellow-500 rounded"></div>
									<span class="text-slate-300">60-79: Warning</span>
								</div>
								<div class="flex items-center gap-2 text-xs">
									<div class="w-3 h-3 bg-red-500 rounded"></div>
									<span class="text-slate-300">0-59: Critical</span>
								</div>
							</div>
						</div>
					</div>
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
</style>
