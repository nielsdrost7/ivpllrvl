<?php

return [
    'invoice' => [
        1 => ['label' => 'Draft', 'class' => 'label-default'],
        2 => ['label' => 'Sent', 'class' => 'label-info'],
        3 => ['label' => 'Viewed', 'class' => 'label-primary'],
        4 => ['label' => 'Paid', 'class' => 'label-success'],
    ],

    'quote' => [
        1 => ['label' => 'Draft', 'class' => 'label-default'],
        2 => ['label' => 'Sent', 'class' => 'label-info'],
        3 => ['label' => 'Approved', 'class' => 'label-success'],
        4 => ['label' => 'Rejected', 'class' => 'label-danger'],
    ],

    'task' => [
        'pending' => ['label' => 'Pending', 'class' => 'label-warning'],
        'in_progress' => ['label' => 'In Progress', 'class' => 'label-info'],
        'completed' => ['label' => 'Completed', 'class' => 'label-success'],
    ],
];
