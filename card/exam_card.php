<div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <div class="p-5">
        <h5 class="text-xl font-bold tracking-tight text-gray-900">
            <?= htmlspecialchars($exam_title) ?>
        </h5>

        <p class="mt-2 text-gray-600 text-sm">
            Duration: <?= htmlspecialchars($duration) ?>
        </p>

        <p class="text-gray-600 text-sm">
            Date: <?= htmlspecialchars($exam_date) ?>
        </p>

        <p class="text-gray-600 text-sm">
            Requirement: <?= htmlspecialchars($requirement) ?>
        </p>

        <p class="text-gray-600 text-sm">
            Course: <?= htmlspecialchars($course) ?> -
            Year: <?= htmlspecialchars($year) ?>
        </p>
    </div>
</div>
