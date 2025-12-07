<div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
    <div class="p-5">
        <h5 class="text-xl font-bold tracking-tight text-gray-900">
            <?= htmlspecialchars($announcement_title) ?>
        </h5>

        <p class="mt-2 text-gray-600 text-sm">
            <?= htmlspecialchars($content) ?>
        </p>

        <p class="text-gray-600 text-sm mt-2">
            Course: <?= htmlspecialchars($course) ?> -
            Year: <?= htmlspecialchars($year) ?>
        </p>
    </div>
</div>
