package community.dddtw.refactor;

import java.util.ArrayList;
import java.util.Arrays;

public class Employee {
    public int[] workHours;
    public String name;

    public Employee(String name, int[] workHours) {
        if (workHours.length != 7) {
            throw new IllegalArgumentException("應該要有一週的工時資料");
        }
        for (int workHour : workHours) {
            if (workHour < 0 || workHour > 16) {
                throw new IllegalArgumentException("工時資料應該為 0 - 16 的數字");
            }
        }

        this.workHours = workHours;
        this.name = name;
    }


    // CFO
    public int calculatePay() {
        return this.regularHours() * 200 + this.overtimeHours() * 350;
    }

    // COO
    public String reportHours() {
        return "Regular Hours: " + this.regularHours();
    }

    // CTO
    public String save() {
        return "saved";
    }


    private int overtimeHours() {
        int hourCounter = 0;
        ArrayList<Integer> workDays = new ArrayList<Integer>(Arrays.asList(1, 2, 3, 4, 5));
        for (int i = 0; i < this.workHours.length; i++) {
            int workDay = i;
            int workHour = this.workHours[i];
            if (workDays.contains(workDay)) {
                hourCounter += Math.max(workHour - 8, 0);
            } else {
                hourCounter += workHour;
            }
        }
        return hourCounter;
    }

    private int regularHours() {
        int hourCounter = 0;
        for (int i = 0; i < this.workHours.length; i++) {
            int workHour = this.workHours[i];
            if (i == 0 || i == 6) {
                continue;
            }
            hourCounter += Math.min(workHour, 8);
        }
        return hourCounter;
    }
}


