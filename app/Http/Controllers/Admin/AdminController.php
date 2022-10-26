<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Tracker;
use App\Models\Assignee;
use App\Models\Assigner;
use App\Models\Category;
use App\Models\Reporter;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\Admin\AdminTicketRequest;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->dashboard();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminTicketRequest $request)
    {
        $forTicket = $request->safe();
        // ->only([
        //     'number', 'title', 'category',
        //     'department', 'description',
        //     'due_date', 'location', 'priority'
        // ]);

        // dd($forTicket);



        return;

        $created_ticket = Ticket::create($forTicket);
        $createdTicketID = $created_ticket->id;

        /*
        A Ticket has:
            > Assignee - staff
            > Assigner - admin
            > Reporter - issue reporter
            > Tracker - reference number
            > Tags
            > Statuses - Open if admin, new if guest
        */

        Assignee::created([
            'tickets_id' => $createdTicketID,
            'users_id' => 1
        ]);

        Assigner::created([
            'tickets_id' => $createdTicketID,
            'users_id' => 1
        ]);


        Tracker::create([
            'tickets_id' => $createdTicketID,
            'reference_code' => 2
        ]);

        Reporter::created([
            'name' => $forTicket['reported_by'],
            'email' => $forTicket['reporter_email'],
            'tickets_id' => $createdTicketID
        ]);

        return redirect()
            ->route('staff.dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login()
    {
        return view('authentication.login');
    }

    public function register()
    {
        return view('authentication.register');
    }

    public function createTicket()
    {
        $departments = Department::all();
        $categories = Category::all();
        $staff = User::where('role_id', 2)->get();

        $ticketNumber = Ticket::getTicketNumber();
        return view(
            'admin.tickets.create_ticket',
            [
                'ticketNumber' => $ticketNumber,
                'categories' => $categories,
                'departments' => $departments,
                'staff' => $staff
            ]
        );
    }

    public function dashboard()
    {
        return view('admin.tickets.all_tickets');
    }

    //Auth
    public function registerAccount(RegisterRequest $request)
    {
        $request->validated();

        $details = $request->safe()->only(['email', 'password']);

        User::create([
            'email' => $details['email'],
            'name' => '',
            'role_id' => 2,
            'password' => $details['password']
        ]);

        return redirect()
            ->route('admin.home');
    }

    public function loginAccount(LoginRequest $request)
    {
        dd($request->email);
    }

    //Categories
    public function createCategories()
    {
        return view('admin.categories.create');
    }

    public function editCategories(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function allCategories()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function storeCategories(CategoryRequest $request)
    {
        //$request->validated();

        Category::create($request->validated());

        return redirect()
            ->route('admin.categories.index');
    }

    public function updateCategory(CategoryRequest $request, Category $category)
    {
        Category::find($category->id)->update($request->validated());

        return redirect()
            ->route('admin.categories.index');
    }

    //Departments
    public function createDepartments()
    {
        return view('admin.departments.create');
    }

    public function editDepartments(Department $department)
    {
        return view('admin.departments.edit', compact('department'));
    }

    public function allDepartments()
    {
        $departments = Department::all();
        return view('admin.departments.index', compact('departments'));
    }

    public function storeDepartments(DepartmentRequest $request)
    {
        Department::create($request->validated());

        return redirect()
            ->route('admin.departments.index')
            ->with('department_status', 'Created succefully!');;
    }

    public function updateDepartments(DepartmentRequest $request, Department $department)
    {
        Department::find($department->id)->update($request->validated());

        return redirect()
            ->route('admin.departments.index')
            ->with('department_status', 'Updated succefully!');
    }

    public function showCategory(Department $department)
    {
        return view('admin.categories.index', compact('department'));
    }

    public function manageAccounts()
    {
        $users = User::all()->where('role_id', '2');

        return view('admin.accounts.index', compact('users'));
    }

    public function createAccount()
    {
    }
}
