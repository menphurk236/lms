import { DashboardService } from '../services/dashboard.service';
import { CustomerService } from '../services/customer.service';

export default ({ $axios }, inject) => {
  const dashboardService = new DashboardService($axios);
  const customerService = new CustomerService($axios);
  inject('dashboardService', dashboardService);
  inject('customerService', customerService);
}
