<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            // Web Development Fundamentals
            [
                'name' => 'Introduction to Laravel',
                'description' => 'Learn the basics of Laravel framework including routing, controllers, views, and Eloquent ORM.',
                'url' => 'https://example.com/courses/laravel-intro',
            ],
            [
                'name' => 'Advanced PHP Development',
                'description' => 'Master PHP with advanced concepts, design patterns, and best practices for enterprise applications.',
                'url' => 'https://example.com/courses/advanced-php',
            ],
            [
                'name' => 'Web Security Fundamentals',
                'description' => 'Learn essential web security practices including XSS prevention, CSRF protection, and SQL injection.',
                'url' => 'https://example.com/courses/web-security',
            ],
            [
                'name' => 'Database Design',
                'description' => 'Master database design, normalization, optimization, and query performance tuning.',
                'url' => 'https://example.com/courses/database-design',
            ],
            [
                'name' => 'API Development',
                'description' => 'Build robust and scalable RESTful APIs with authentication, rate limiting, and documentation.',
                'url' => 'https://example.com/courses/api-dev',
            ],

            // Frontend Development
            [
                'name' => 'Modern JavaScript',
                'description' => 'Master modern JavaScript including ES6+, async/await, modules, and best practices.',
                'url' => 'https://example.com/courses/modern-js',
            ],
            [
                'name' => 'Vue.js Fundamentals',
                'description' => 'Learn Vue.js 3 including composition API, components, routing, and state management.',
                'url' => 'https://example.com/courses/vuejs',
            ],
            [
                'name' => 'React Essentials',
                'description' => 'Build modern web applications with React, hooks, context API, and Redux.',
                'url' => 'https://example.com/courses/react',
            ],
            [
                'name' => 'CSS Mastery',
                'description' => 'Advanced CSS techniques including Flexbox, Grid, animations, and responsive design.',
                'url' => 'https://example.com/courses/css-mastery',
            ],
            [
                'name' => 'TypeScript Development',
                'description' => 'Learn TypeScript for building type-safe JavaScript applications.',
                'url' => 'https://example.com/courses/typescript',
            ],

            // Backend Development
            [
                'name' => 'Node.js Backend Development',
                'description' => 'Build scalable backend services with Node.js, Express, and MongoDB.',
                'url' => 'https://example.com/courses/nodejs',
            ],
            [
                'name' => 'Python Django Framework',
                'description' => 'Create web applications using Django framework with best practices.',
                'url' => 'https://example.com/courses/django',
            ],
            [
                'name' => 'Microservices Architecture',
                'description' => 'Design and implement microservices using modern technologies and patterns.',
                'url' => 'https://example.com/courses/microservices',
            ],
            [
                'name' => 'Docker & Kubernetes',
                'description' => 'Master containerization and orchestration for modern applications.',
                'url' => 'https://example.com/courses/docker-k8s',
            ],
            [
                'name' => 'AWS Cloud Services',
                'description' => 'Learn essential AWS services for modern web applications.',
                'url' => 'https://example.com/courses/aws',
            ],

            // Software Engineering
            [
                'name' => 'Clean Code Principles',
                'description' => 'Write maintainable and clean code using SOLID principles and best practices.',
                'url' => 'https://example.com/courses/clean-code',
            ],
            [
                'name' => 'Test-Driven Development',
                'description' => 'Master TDD methodology with practical examples and best practices.',
                'url' => 'https://example.com/courses/tdd',
            ],
            [
                'name' => 'Design Patterns in PHP',
                'description' => 'Implement common design patterns in PHP applications.',
                'url' => 'https://example.com/courses/design-patterns',
            ],
            [
                'name' => 'Git Version Control',
                'description' => 'Master Git including branching strategies, workflows, and collaboration.',
                'url' => 'https://example.com/courses/git',
            ],
            [
                'name' => 'Agile Development',
                'description' => 'Learn Agile methodologies and Scrum framework for project management.',
                'url' => 'https://example.com/courses/agile',
            ],

            // Mobile Development
            [
                'name' => 'Flutter Development',
                'description' => 'Build cross-platform mobile apps with Flutter and Dart.',
                'url' => 'https://example.com/courses/flutter',
            ],
            [
                'name' => 'React Native',
                'description' => 'Create native mobile applications using React Native.',
                'url' => 'https://example.com/courses/react-native',
            ],
            [
                'name' => 'iOS Development with Swift',
                'description' => 'Build iOS applications using Swift and SwiftUI.',
                'url' => 'https://example.com/courses/ios-swift',
            ],
            [
                'name' => 'Android Development',
                'description' => 'Create Android apps using Kotlin and Jetpack Compose.',
                'url' => 'https://example.com/courses/android',
            ],
            [
                'name' => 'Progressive Web Apps',
                'description' => 'Build progressive web apps with modern web technologies.',
                'url' => 'https://example.com/courses/pwa',
            ],

            // Data & AI
            [
                'name' => 'Machine Learning Basics',
                'description' => 'Introduction to machine learning concepts and algorithms.',
                'url' => 'https://example.com/courses/ml-basics',
            ],
            [
                'name' => 'Data Science with Python',
                'description' => 'Learn data analysis and visualization using Python.',
                'url' => 'https://example.com/courses/data-science',
            ],
            [
                'name' => 'AI in Web Applications',
                'description' => 'Integrate AI capabilities into web applications.',
                'url' => 'https://example.com/courses/ai-web',
            ],
            [
                'name' => 'Big Data Processing',
                'description' => 'Process and analyze large datasets using modern tools.',
                'url' => 'https://example.com/courses/big-data',
            ],
            [
                'name' => 'Natural Language Processing',
                'description' => 'Build applications with natural language processing capabilities.',
                'url' => 'https://example.com/courses/nlp',
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
