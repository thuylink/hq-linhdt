<?php

namespace App\Http\Services;

use App\Jobs\SendOrderSuccessJob;
use App\Models\Admin;
use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\Interface\OrderRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepositoryInterface
    ) {}
    public function index()
    {
        $orders = $this->orderRepositoryInterface->all();
        return response()->json([
            'orders' => $orders
        ]);
    }

    public function store(array $data)
    {
        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $data['user_id'],
            ]);

            foreach ($data['books'] as &$bookData) {
                $book = Book::find($bookData['book_id']);
                if ($book) {
                    $orderItem = OrderItem::create([
                        'order_id' => $order->id,
                        'book_id' => $book->id,
                        'quantity' => $bookData['quantity'],
                        'price' => $book->price
                    ]);

                    $bookData['name'] = $book->name;
                }
            }

            $user = Admin::find($data["user_id"]);
            $orderItems = $order->orderItems;
            foreach ($orderItems as &$orderItem) {
                $book = Book::find($orderItem->book_id);
                if ($book) {
                    $orderItem->name = $book->name;
                }
            }

            SendOrderSuccessJob::dispatch($user, $order);

            DB::commit();

            return [
                'message' => 'Order successfully created',
                'order' => [
                    'id' => $order->id,
                    'user_id' => $order->user_id,
                    'created_at' => $order->created_at,
                    'updated_at' => $order->updated_at,
                    'order_items' => $orderItems,
                ]
            ];
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateStatus(int $id, array $data)
    {
        $dataUpdate = [
            'status' => $data['status'],
        ];
        $order = $this->orderRepositoryInterface->update($id, $dataUpdate);
        return $order;
    }
}
