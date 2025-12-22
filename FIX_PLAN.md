# خطة إصلاح مشكلة التيكت للمدير

## المشاكل المحددة من التشخيص:

1. **التيكت مربوط بموظف مش مربوط بالمدير**
   - Employee User 1 عنده Employee ID = 11
   - Manager_employee_id = NULL (مش مربوط بأي مدير)
   - بس عنده 2 تيكت!

2. **الموظفين المربوطين بالمدير مش عندهم تيكت**
   - Employee IDs: 20, 21, 22, 23 مربوطين بـ Manager Employee ID = 6
   - بس مش عندهم تيكت أصلاً

3. **مشاكل في user-employee relationships**
   - بعض الموظفين عندهم user_id مش مربوط صح

## خطة الإصلاح:

### الخطوة 1: إصلاح user-employee relationships
- ربط الموظفين بالموظفين الصح

### الخطوة 2: ربط التيكت بالمدير الصحيح
- إما ربط التيكت الحالي بالمدير المناسب
- أو إنشاء تيكت جديد للموظف المربوط بالمدير

### الخطوة 3: اختبار الحل
- التأكد من ظهور التيكت للمدير

## الأوامر للتشخيص:
```sql
-- فحص البيانات المكسورة
SELECT e.id, e.user_id, u.name, u.email, e.manager_employee_id
FROM employees e 
LEFT JOIN users u ON e.user_id = u.id 
WHERE u.id IS NULL;

-- فحص التيكت الحالي
SELECT t.id, t.user_id, u.name, u.email, e.manager_employee_id
FROM tickets t
JOIN users u ON t.user_id = u.id
JOIN employees e ON u.id = e.user_id;

-- فحص الموظفين المربوطين بالمدير
SELECT e.id, e.user_id, u.name, u.email, e.manager_employee_id
FROM employees e
JOIN users u ON e.user_id = u.id
WHERE e.manager_employee_id = 6;
