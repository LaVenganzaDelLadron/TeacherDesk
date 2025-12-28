<script setup lang="ts">
import { onBeforeUnmount, onMounted, ref, watch } from 'vue';

const props = defineProps<{ message: string }>();

const visible = ref(!!props.message);
let timer: ReturnType<typeof setTimeout> | null = null;

const scheduleHide = () => {
	if (timer) clearTimeout(timer);
	timer = setTimeout(() => {
		visible.value = false;
	}, 4500);
};

watch(
	() => props.message,
	(val) => {
		visible.value = !!val;
		if (val) scheduleHide();
	}
);

onMounted(() => {
	if (props.message) scheduleHide();
});

onBeforeUnmount(() => {
	if (timer) clearTimeout(timer);
});

const close = () => {
	visible.value = false;
};
</script>

<template>
	<transition name="fade-slide">
		<div
			v-if="visible"
			class="fixed right-5 top-5 z-50 w-80 rounded-xl border border-rose-400/50 bg-rose-500/10 p-4 text-sm text-rose-100 shadow-xl shadow-rose-500/25 backdrop-blur"
			role="alert"
			aria-live="assertive"
		>
			<div class="flex items-start gap-3">
				<span class="flex h-8 w-8 items-center justify-center rounded-full bg-rose-500/20 text-rose-200 ring-1 ring-rose-400/50">!</span>
				<div class="flex-1 leading-snug">
					<p class="font-semibold text-rose-100">Action needed</p>
					<p class="text-rose-100/90">{{ message }}</p>
				</div>
				<button class="text-rose-200 transition hover:text-white" type="button" @click="close" aria-label="Close alert">×</button>
			</div>
		</div>
	</transition>
</template>

<style scoped>
.fade-slide-enter-active,
.fade-slide-leave-active {
	transition: all 0.2s ease;
}

.fade-slide-enter-from,
.fade-slide-leave-to {
	opacity: 0;
	transform: translateY(-6px);
}
</style>
