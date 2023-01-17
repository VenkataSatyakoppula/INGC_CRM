from django.urls import path
from . import views


urlpatterns = [
    # path('/createemployees', views.createemployees),
    # path('/createservices', views.createservices),
    path('register',views.register),
    path('login',views.login),
    path('logout',views.logout),
    path('add_service',views.add_service),
    path('service_list/<int:id>',views.list),
    path('update_service/<int:eid>/<int:id>',views.update_service),
    path('delete_service/<int:eid>/<int:id>',views.delete_service),
    path('delete/<int:ref_id>/<int:role_id>',views.delEmp),
    path('deleteemp/<int:id>', views.delEmploye),
    path('updateManager/<int:id>',views.updateManager),
    path('managerDetail/<int:id>',views.managerDetail),
    path('view_employees',views.viewlist),
    path('updateEmp/<int:role_id>/<int:ref_id>',views.updateEmp),


]