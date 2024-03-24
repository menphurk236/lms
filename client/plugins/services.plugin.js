import { DashboardService } from '../services/dashboard.service';
import { EmployeeService } from '../services/employee.service';
import { UserService } from '../services/user.service';
import { VideoService } from '../services/video.service';
import { CategoryService } from '../services/category.service';

export default ({ $axios }, inject) => {
  const dashboardService = new DashboardService($axios);
  const employeeService = new EmployeeService($axios);
  const userService = new UserService($axios);
  const videoService = new VideoService($axios);
  const categoryService = new CategoryService($axios);
  inject('dashboardService', dashboardService);
  inject('employeeService', employeeService);
  inject('userService', userService);
  inject('videoService', videoService);
  inject('categoryService', categoryService);
}
