<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the authenticated home dashboard.
     */
    public function index(): View
    {
        $user = Auth::user();

        // Sample learning track nodes for practice preview
        $practiceModules = [
            [
                'id' => 1,
                'title' => 'Foundations of Machine Learning',
                'description' => 'Understand data splits, loss functions, and evaluation metrics.',
                'progress' => 100,
                'status' => 'completed',
                'level' => 'Beginner',
                'xp' => 150,
            ],
            [
                'id' => 2,
                'title' => 'Linear & Logistic Regression',
                'description' => 'Build and optimize your first predictive mathematical models.',
                'progress' => 60,
                'status' => 'in_progress',
                'level' => 'Beginner',
                'xp' => 220,
            ],
            [
                'id' => 3,
                'title' => 'Deep Neural Networks & Backpropagation',
                'description' => 'Construct multi-layer perceptrons from scratch with matrix math.',
                'progress' => 0,
                'status' => 'locked',
                'level' => 'Intermediate',
                'xp' => 350,
            ],
            [
                'id' => 4,
                'title' => 'Convolutional Networks for Vision',
                'description' => 'Feature maps, pooling layers, and image classification pipelines.',
                'progress' => 0,
                'status' => 'locked',
                'level' => 'Intermediate',
                'xp' => 400,
            ],
            [
                'id' => 5,
                'title' => 'Transformers & Large Language Models',
                'description' => 'Self-attention mechanisms, tokenization, and fine-tuning models.',
                'progress' => 0,
                'status' => 'locked',
                'level' => 'Advanced',
                'xp' => 500,
            ],
        ];

        return view('home', compact('user', 'practiceModules'));
    }
}
