


1 first run project using php artisan serve
2 run migration php artisan migration
3 run also seeder because we define role in seeder
4 now when all process run first time show with project base url php welcom page
5 next http://127.0.0.1:8000/admin/dashboard it return redirect login page if not admi aor manager aor user login
6 i make two page login and register
7 first Admin ,Manager and User can create account where pass role in request when create account
8 let supose if Admin can create account account it return redirect admin/dashboard pasge
9 here admin can create Project update,show and delete project
10 also admin can see Task each project and task creater name and task assigner name
11 Admin can also comment of each task and see task comment list
12 Admin can also see task status
13 admin can generate pdf of task report related of project aslo 
-> admin can also see chart of whole projet according to task status and priority
-> adim can search task accordin to status ,prority and date
14 admin can logout 
15 Now When manager can create account base on role it return redirect manager/dashbaord
16 here manager can create task aaupdate task delete task and show task
17 manager can assign task any user
18 manager can see task status 
19 manager can comment any task and also see maeesage of list 
20  Now when employee User can create accont it return redieect employee/dashboard page
21 here Each employee can see our task and see who can assign these task
22 show all task list
23 user can change task statsu
24 user can leave comment of the task and aslo show all comment list of same  task 
25 in comment show task name comment and User name,Manager name and Admin name show in User name head

->aslo user recevied mail notifiaction on thir mail  
->aslo run php artisan queue:work  command 



Api Document
i will share you collection 
->i work curd project  only admin can accrodin their role if any one do then this will show unauthorizes 
-> curd  task only manager can perfume  role if any one do then this will show unauthorizes 

-> comment can admin ,manager and employ 


APi 

1 login 
method post 
http://127.0.0.1:8000/api/login
email   (requird)
password   (requird)
 
 this api return token



 2 create project (requir token admin)
 method post
http://127.0.0.1:8000/api/projects 

{
    "name": "demo update api test",
    "description": "this is  demo for update api test",
    "start_date": "2024-08-12",
    "end_date": "2024-09-12"
}

 3 show project (requir token admin)
 method get
http://127.0.0.1:8000/api/projects 



4 update project (requir token admin)
method put
http://127.0.0.1:8000/api/projects/id
{
    "name": "demo update api test",
    "description": "this is  demo for update api test",
    "start_date": "2024-08-12",
    "end_date": "2024-09-12"
}


5 delete project (requir token admin)
method delete
http://127.0.0.1:8000/api/projects/id




Task 

6 create task (requir token manager)
 method post
http://127.0.0.1:8000/api/tasks
{

    "project_id" : 1,
    "name": "task update for api",
    "description" : "this is  demo task for update api test",
    "status" : "in_progress",
    "assigned_to" :4,
    "priority":  "low",
    "due_date": "2024-08-12"
   
   
}


6 show task (requir token manager)
 method get
http://127.0.0.1:8000/api/tasks



7 update task (requir token manager)
 method put
http://127.0.0.1:8000/api/tasks/id
{

    "project_id" : 1,
    "name": "task update for api",
    "description" : "this is  demo task for update api test",
    "status" : "in_progress",
    "assigned_to" :4,
    "priority":  "low",
    "due_date": "2024-08-12"
   
   
}

8 delete task (requir token manager)
 method delete
http://127.0.0.1:8000/api/tasks/id



comments
9 create comments (requir token)
 method post
http://127.0.0.1:8000/api/comments
{
        "comment": "hi this comment for api side",
        "task_id": "3",
        
    }


10 create comments (requir token)
 method get
 http://127.0.0.1:8000/api/comments