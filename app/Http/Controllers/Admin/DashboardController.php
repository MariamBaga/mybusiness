<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\Partner;
use App\Models\Advertisement;
use App\Models\Document;
use App\Models\Contact;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques de base
        $stats = [
            'posts'        => Post::count(),
            'products'     => Product::count(),
            'partners'     => Partner::count(),
            'ads'          => Advertisement::where('status', 'active')->count(),
            'documents'    => Document::where('status', true)->count(), // Changé ici
            'messages'     => Contact::where('status', false)->count(),
            'tickets'      => Ticket::count(),
            'tickets_open' => Ticket::where('status', 'open')->count(),
            'users'        => User::count(),
            'tickets_closed' => Ticket::where('status', 'closed')->count(),
        ];

        // Statistiques pour les graphiques
        $chartData = [
            'tickets_by_status' => [
                'open' => Ticket::where('status', 'open')->count(),
                'in_progress' => Ticket::where('status', 'in_progress')->count(),
                'closed' => Ticket::where('status', 'closed')->count(),
                'pending' => Ticket::where('status', 'pending')->count(),
            ],
            'tickets_last_30_days' => $this->getTicketsLast30Days(),
            'messages_last_30_days' => $this->getMessagesLast30Days(),
            'products_by_status' => [
                'active' => Product::where('status', 'active')->count(),
                'draft' => Product::where('status', 'draft')->count(),
                'archived' => Product::where('status', 'archived')->count(),
            ],
            'recent_activities' => $this->getRecentActivities(),
            'top_products' => $this->getTopProducts(5),
            'latest_tickets' => Ticket::with('user')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
            'latest_messages' => Contact::orderBy('created_at', 'desc')
                ->limit(5)
                ->get(),
        ];

        return view('admin.dashboard', compact('stats', 'chartData'));
    }

    private function getTicketsLast30Days()
    {
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(30);

        $tickets = Ticket::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $labels = [];
        $data = [];

        // Remplir les 30 derniers jours
        for ($i = 30; $i >= 0; $i--) {
            $date = $endDate->copy()->subDays($i)->format('Y-m-d');
            $labels[] = $endDate->copy()->subDays($i)->format('d/m');

            $ticketCount = $tickets->firstWhere('date', $date);
            $data[] = $ticketCount ? $ticketCount->count : 0;
        }

        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    private function getMessagesLast30Days()
    {
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(30);

        $messages = Contact::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $data = [];

        for ($i = 30; $i >= 0; $i--) {
            $date = $endDate->copy()->subDays($i)->format('Y-m-d');
            $messageCount = $messages->firstWhere('date', $date);
            $data[] = $messageCount ? $messageCount->count : 0;
        }

        return $data;
    }

   private function getRecentActivities()
{
    // Récupérer les activités récentes de différents modèles
    $activities = collect();

    // Derniers articles - CHANGÉ ICI : 'author' au lieu de 'user'
    $posts = Post::with('author')  // Changé de 'user' à 'author'
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get()
        ->map(function ($post) {
            return [
                'type' => 'post',
                'title' => 'Nouvel article',
                'description' => $post->title,
                'user' => $post->author->name ?? 'Admin',  // Changé de $post->user à $post->author
                'time' => $post->created_at->diffForHumans(),
                'icon' => 'fas fa-newspaper',
                'color' => 'primary'
            ];
        });

    // Derniers produits
    $products = Product::orderBy('created_at', 'desc')
        ->limit(3)
        ->get()
        ->map(function ($product) {
            return [
                'type' => 'product',
                'title' => 'Nouveau produit',
                'description' => $product->name,
                'user' => 'System',
                'time' => $product->created_at->diffForHumans(),
                'icon' => 'fas fa-box',
                'color' => 'success'
            ];
        });

    // Derniers tickets
    $tickets = Ticket::with('user')
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get()
        ->map(function ($ticket) {
            return [
                'type' => 'ticket',
                'title' => 'Nouveau ticket',
                'description' => $ticket->subject,
                'user' => $ticket->user->name ?? 'Utilisateur',
                'time' => $ticket->created_at->diffForHumans(),
                'icon' => 'fas fa-ticket-alt',
                'color' => 'danger'
            ];
        });

    // Fusionner et trier par date
    $activities = $activities->merge($posts)->merge($products)->merge($tickets);

    return $activities->sortByDesc('time')->take(6)->values();
}

    private function getTopProducts($limit = 5)
    {
        // Si votre modèle Product a un champ pour les vues ou les ventes
        // Si pas de champ 'views', utilisez 'created_at' ou autre
        return Product::where('status', 'active')
            ->orderBy('created_at', 'desc') // ou 'views' si vous avez ce champ
            ->limit($limit)
            ->get(['id', 'name', 'price', 'image']);
    }
}
