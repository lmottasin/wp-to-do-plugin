<?php

echo '<table class="todo-table">';
echo '<tr><th>ID</th><th>Task</th><th>Status</th><th>Created At</th></tr>';
foreach ($todo_items as $item) {
    echo '<tr>';
    echo '<td>' . $item['id'] . '</td>';
    echo '<td>' . $item['task'] . '</td>';
    echo '<td>' . ($item['completed'] ? 'Completed' : 'Pending') . '</td>';
    echo '<td>' . $item['created_at'] . '</td>';
    echo '</tr>';
}
echo '</table>';