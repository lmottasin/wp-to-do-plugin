<table class="w-full border-collapse border border-gray-300">
    <thead>
    <tr>
        <th class="p-3 text-left bg-gray-100 border border-red-500">ID</th>
        <th class="p-3 text-left bg-gray-100 border border-gray-300">Task</th>
        <th class="p-3 text-left bg-gray-100 border border-gray-300">Status</th>
        <th class="p-3 text-left bg-gray-100 border border-gray-300">Created At</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($todo_items as $item) : ?>
        <tr>
            <td class="p-3 border border-gray-300"><?= $item['id'] ?></td>
            <td class="p-3 border border-gray-300"><?= $item['task'] ?></td>
            <td class="p-3 border border-gray-300"><?= $item['completed'] ? 'Completed' : 'Pending' ?></td>
            <td class="p-3 border border-gray-300"><?= $item['created_at'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

