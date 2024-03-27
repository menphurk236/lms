import { DashboardService } from '../services/dashboard.service';
import { EmployeeService } from '../services/employee.service';
import { UserService } from '../services/user.service';
import { VideoService } from '../services/video.service';
import { CategoryService } from '../services/category.service';
import { DepartmentService } from '../services/department.service';
import { MasterDataService } from '../services/masterdata.service';
import { HomeService } from '../services/home.service';

export default ({ $axios }, inject) => {
  const dashboardService = new DashboardService($axios);
  const employeeService = new EmployeeService($axios);
  const userService = new UserService($axios);
  const videoService = new VideoService($axios);
  const categoryService = new CategoryService($axios);
  const departmentService = new DepartmentService($axios);
  const masterDataService = new MasterDataService($axios);
  const homeService = new HomeService($axios);
  inject('dashboardService', dashboardService);
  inject('employeeService', employeeService);
  inject('userService', userService);
  inject('videoService', videoService);
  inject('categoryService', categoryService);
  inject('departmentService', departmentService);
  inject('masterDataService', masterDataService);
  inject('homeService', homeService);
}
