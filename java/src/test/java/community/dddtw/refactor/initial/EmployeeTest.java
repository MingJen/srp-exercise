package community.dddtw.refactor.initial;

import community.dddtw.refactor.initial.Employee;
import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.assertEquals;
import static org.junit.jupiter.api.Assertions.assertThrows;

class EmployeeTest {
    private Employee employee;

    @org.junit.jupiter.api.BeforeEach
    void setUp() {
        employee = new Employee(
                "Bob",
                new int[]{
                        4, // Sun.
                        9, // Mon.
                        8, // Tue.
                        5, // Wed.
                        9, // Thu.
                        9, // Fri.
                        7 // Sat.
                }
        );
    }

//    @Test
//    void test_calculatePay() {
//        assertEquals(this.employee.calculatePay(), 12300);
//    }

//     TODO: Fix it to meet the new requirement
//    @Test
//    void test_calculatePay_on_solid_wednesday() {
//        assertEquals(this.employee.calculatePay(), 13600);
//    }


    @Test
    void test_report() {
        assertEquals(this.employee.reportHours(), "Regular Hours: 37");
    }
//     TODO: Fix it to meet the new requirement
//    @Test
//    void test_report_on_solid_wednesday() {
//        assertEquals(this.employee.reportHours(), "Regular Hours: 37");
//    }


    @Test
    void should_throw_if_no_whole_week_data() {
        Exception exception = assertThrows(IllegalArgumentException.class, () -> {
            new Employee("Foo", new int[]{1});
        });
        assertEquals(exception.getMessage(), "應該要有一週的工時資料");
    }


    @Test
    void should_throw_if_any_workhour_out_of_range() {
        Exception exception = assertThrows(IllegalArgumentException.class, () -> {
            new Employee("Foo", new int[]{7, 7, 7, 17, 7, 7, 7});
        });
        assertEquals(exception.getMessage(), "工時資料應該為 0 - 16 的數字");
    }
}