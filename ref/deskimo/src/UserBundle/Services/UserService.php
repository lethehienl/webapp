<?php

namespace UserBundle\Services;

use AppBundle\Services\AbstractService;
use AppBundle\Utils\DateTimeUtil;
use AppBundle\Utils\FileUtil;
use AppBundle\Utils\SecurityUtil;
use AppBundle\Utils\ServiceUtil;
use AppBundle\Utils\StatusUtil;
use AppBundle\Utils\StringUtil;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use UserBundle\Entity\RolePermission;
use UserBundle\Entity\User;
use UserBundle\Repository\UserRepository;
use UserBundle\Utils\GroupUtil;
use UserBundle\Utils\PermissionUtil;
use UserBundle\Utils\RolesUtil;
use UserBundle\Utils\UserUtil;
use Cocur\Slugify\Slugify;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UserService extends AbstractService
{
  public function getEmployers()
  {
    $draw = (int)$this->getRequest()->get('draw');
    $keyword = $this->getRequest()->get('keyword');
    $status = $this->getRequest()->get('status');
    $offset = $this->getRequest()->get('start');

    $data = array(
      'draw' => $draw,
      'recordsTotal' => 0,
      'recordsFiltered' => 0,
      'data' => array()
    );

    /** @var UserRepository $employerRepo */
    $employerRepo = $this->getRepository(User::class);
    $totalEmployer = $employerRepo->getTotalEmployer($keyword, $status);

    if ($totalEmployer == 0) {
      return $data;
    }

    $employers = $employerRepo->getEmployers($keyword, $status, $offset);

    if (empty($employers)) {
      return $data;
    }

    $employers = $this->decorateEmployer($employers);
    $data['recordsTotal'] = $totalEmployer;
    $data['recordsFiltered'] = $totalEmployer;
    $data['data'] = $employers;

    return $data;
  }

  public function getUsers()
  {
    $draw = (int)$this->getRequest()->get('draw');
    $keyword = $this->getRequest()->get('keyword');
    $status = $this->getRequest()->get('status');
    $offset = $this->getRequest()->get('start');

    $data = array(
      'draw' => $draw,
      'recordsTotal' => 0,
      'recordsFiltered' => 0,
      'data' => array()
    );

    /** @var UserRepository $employerRepo */
    $userRepo = $this->getRepository(User::class);
    $totalUser = $userRepo->getTotalUsers($keyword);

    if ($totalUser == 0) {
      return $data;
    }

    $users = $userRepo->getUsers($keyword, $status, $offset);

    if (empty($users)) {
      return $data;
    }

    $users = $this->decorateUser($users);
    $data['recordsTotal'] = $totalUser;
    $data['recordsFiltered'] = $totalUser;
    $data['data'] = $users;

    return $data;
  }

  private function decorateUser($users)
  {
    $userTmp = array();

    if (empty($users)) {
      return $userTmp;
    }

    /** @var User $user */
    foreach ($users as $user) {
      $userProfile = $user->getUserProfile();

      if (empty($userProfile)) {
        continue;
      }

      $userEditUrl = $this->getRoute()->generate('admin_user_edit_route', ['id' => $user->getId()]);

      $userTmp[] = [
        '',
        $userEditUrl,
        $user->getFullName(),
        $user->getUsername(),
        $userProfile->getPhoneNumber(),
        UserUtil::USER_STATUS_MAPPING[$user->getStatus()],
        DateTimeUtil::formatDate($user->getUpdatedAt()),
        '',
        '',
      ];
    }

    return $userTmp;
  }

  private function decorateEmployer($employers)
  {
    $employerTmp = array();

    if (empty($employers)) {
      return $employerTmp;
    }

    /** @var User $employer */
    foreach ($employers as $employer) {
      /** @var UserProfile $employerProfile */
      $employerProfile = $employer->getUserProfile();

      if (empty($employerProfile)) {
        continue;
      }

      /** @var Company $company */
      $company = $employerProfile->getCompany();
      $companyName = (empty($company)) ? 'N/A' : $company->getName();
      $employerEditUrl = $employer->getSlug() ? $this->getRoute()->generate('admin_employer_edit_route', ['slug' => $employer->getSlug()]) : '#';

      $employerTmp[] = [
        $employerEditUrl,
        $employer->getFullName(),
        $employer->getUsername(),
        $employerProfile->getPhoneNumber(),
        $companyName,
        UserUtil::USER_STATUS_MAPPING[$employer->getStatus()]
      ];
    }

    return $employerTmp;
  }

  public function createOrUpdateUser(User $user)
  {
    $password = $user->getPassword();

    if (!empty($password)) {
      $hashPassword = $this->getService(ServiceUtil::PASSWORD_ENCODER_SERVICE)->encodePassword($user, $password);
      $user->setPassword($hashPassword);
    }

    $this->persistAndFlush($user);
    return $user;
  }

  public function createUser(User $user)
  {
    $this->persistAndFlush($user);
    return $user;
  }

  public function getCompanies()
  {
    $draw = (int)$this->getRequest()->get('draw');
    $keyword = $this->getRequest()->get('keyword');
    $offset = $this->getRequest()->get('start');

    $data = [
      'draw' => $draw,
      'recordsTotal' => 0,
      'recordsFiltered' => 0,
      'data' => []
    ];

    /** @var UserRepository $userRepo */
    $userRepo = $this->getRepository(User::class);
    $totalCompany = $userRepo->getTotalCompany($keyword);

    if ($totalCompany == 0) {
      return $data;
    }

    $companies = $userRepo->getCompanies($keyword, $offset);

    if (empty($companies)) {
      return $data;
    }

    $companies = $this->decorateCompany($companies);
    $data['recordsTotal'] = $totalCompany;
    $data['recordsFiltered'] = $totalCompany;
    $data['data'] = $companies;

    return $data;
  }

  private function decorateCompany($companies)
  {
    $companyTmp = [];

    if (empty($companies)) {
      return $companyTmp;
    }

    $contractRepo = $this->getRepository('ContractBundle:Contract');
    /** @var Company $company */
    foreach ($companies as $company) {
      $companyEditUrl = $this->getRoute()->generate('admin_company_edit_route', ['slug' => $company['slug']]);
      $companyClbContractUrl = $this->getRoute()->generate('admin_contracts_clb_company', ['slug' => $company['slug']]);
      $companyGroupsUrl = $this->getRoute()->generate('admin_company_group_list_route', ['slug' => $company['slug']]);
      $totalContract = $contractRepo->getTotalContract('', -1, [ContractUtil::CONTRACT_COURSE, ContractUtil::CONTRACT_STORAGE], $company['id']);

      $companyTmp[] = [
        '',
        $company['name'],
        $company['username'],
        $company['companyCode'] ?? '',
        $totalContract,
        DateTimeUtil::formatDate($company['updatedAt']),//4
        $company['status'],
        $company['id'],
        $companyEditUrl,
        $companyClbContractUrl,
        $companyGroupsUrl
      ];
    }

    return $companyTmp;
  }

  public function getTrainers()
  {
    $draw = (int)$this->getRequest()->get('draw');
    $keyword = $this->getRequest()->get('keyword');
    $status = $this->getRequest()->get('status');
    $offset = $this->getRequest()->get('start');

    $data = [
      'draw' => $draw,
      'recordsTotal' => 0,
      'recordsFiltered' => 0,
      'data' => []
    ];

    /** @var UserRepository $userRepo */
    $userRepo = $this->getRepository(User::class);
    $totalTrainer = $userRepo->getTotalTrainer($keyword, $status);

    if ($totalTrainer == 0) {
      return $data;
    }

    $trainers = $userRepo->getTrainers($keyword, $status, $offset);

    if (empty($trainers)) {
      return $data;
    }

    $trainers = $this->decorateTrainer($trainers);
    $data['recordsTotal'] = $totalTrainer;
    $data['recordsFiltered'] = $totalTrainer;
    $data['data'] = $trainers;

    return $data;
  }

  public function decorateTrainer($trainers)
  {
    $trainerTmp = [];

    if (empty($trainers)) {
      return $trainerTmp;
    }

    /** @var User $trainer */
    foreach ($trainers as $trainer) {
      /** @var UserProfile $employerProfile */
      $employerProfile = $trainer->getUserProfile();

      if (empty($employerProfile)) {
        continue;
      }

      $employerEditUrl = $trainer->getSlug() ? $this->getRoute()->generate('admin_trainer_edit_route', ['slug' => $trainer->getSlug()]) : '#';

      $trainerTmp[] = [
        '',
        $trainer->getFullName(),
        $trainer->getUsername(),
        $employerProfile->getPhoneNumber(),
        $trainer->getStatus(),
        $employerEditUrl,
        $trainer->getId()
      ];
    }

    return $trainerTmp;
  }

  public function createTrainer(User $trainer)
  {
    $email = $trainer->getUsername();

    $trainerData = $this->getRepository(User::class)->findOneBy(['username' => $email]);

    if ($trainerData !== null) {
      throw new \Exception('Email is existed', 1912);
    }

    $memoryLimit = ini_get('memory_limit');
    ini_set('memory_limit', '44M');

    $fullName = $trainer->getFullName();
    $slug = Slugify::create()->slugify($fullName);
    $currentTimestamp = DateTimeUtil::getCurrentTimestamp();
    $slug .= "-{$currentTimestamp}";

    $trainer->setSlug($slug);
    $trainer->setRoleId(array_search(RolesUtil::ROLE_TRAINER, RolesUtil::ROLE_MAPPING));
    $phoneNumber = $trainer->getPhoneNumber();

    $profile = new UserProfile();
    $profile->setUser($trainer);
    $profile->setPhoneNumber($phoneNumber);
    $this->persist($profile);
    $this->persistAndFlush($trainer);
    return $trainer;
  }


  public function getEmployeeByGroup()
  {
    $draw = (int)$this->getRequest()->get('draw');
    $keyword = $this->getRequest()->get('keyword');
    $status = $this->getRequest()->get('status');
    $group = $this->getRequest()->get('group');
    $offset = $this->getRequest()->get('start');

    $user = $this->getLoggedUser();
    $companyId = $user->getCompany()->getId();

    $data = [
      'draw' => $draw,
      'recordsTotal' => 0,
      'recordsFiltered' => 0,
      'data' => []
    ];


    /** @var UserRepository $employeeRepo */
    $employeeRepo = $this->getRepository(User::class);
    $totalEmployee = $employeeRepo->getTotalEmployeeByGroup($keyword, $status, $group, $companyId);

    if ($totalEmployee == 0) {
      return $data;
    }

    $employees = $employeeRepo->getEmployeeByGroup($keyword, $status, $group, $companyId, $offset);

    if (empty($employees)) {
      return $data;
    }

    $employees = $this->decorateEmployeeByCompany($employees);
    $data['recordsTotal'] = $totalEmployee;
    $data['recordsFiltered'] = $totalEmployee;
    $data['data'] = $employees;

    return $data;
  }

  public function decorateEmployeeByCompany($employees)
  {
    $employeeTmp = [];

    if (empty($employees)) {
      return $employeeTmp;
    }

    /** @var \ContractBundle\Repository\CourseInvitationRepository $invitationRepo */
    $invitationRepo = $this->getRepository(CourseInvitation::class);
    /** @var LearningProgressRepository $learningProgressRepo */
    $learningProgressRepo = $this->getRepository(LearningProgress::class);
    /** @var User $employee */
    foreach ($employees as $employee) {

      /** @var UserProfile $employerProfile */
      $employerProfile = $employee->getUserProfile();
      if (empty($employerProfile)) {
        continue;
      }

      $totalCourse = $invitationRepo->getTotalCourseByEmployeeId($employee->getId());
      $employeeEditUrl = $employee->getSlug() ? $this->getRoute()->generate('company_employee_edit_route', ['slug' => $employee->getSlug(), 'id' => $employee->getId()]) : '#';
      $employeeDetails = $employee->getSlug() ? $this->getRoute()->generate('company_employee_details_route', ['slug' => $employee->getSlug(), 'id' => $employee->getId()]) : '#';
      $latestProgress = $learningProgressRepo->getLatestProgress($employee->getId());
      /** @var LearningProgress $latestProgress */
      $lastActive = '';
      if (!empty($latestProgress)) {
        $latestProgress = $latestProgress[0] ?? '';
        $lastActive = $latestProgress->getUpdatedAt();
        $lastActive = DateTimeUtil::timeAgo($lastActive);
      }

      $employeeTmp[] = [
        '',
        $employee->getFullName(),
        $employee->getUsername(),
        $employerProfile->getEmployeeCode(),
        $totalCourse,
        $lastActive,
        $employeeEditUrl,
        $employee->getId(),
        $employeeDetails
      ];
    }

    return $employeeTmp;
  }

  public function forgotPassword($username)
  {
    $filter = ['username' => $username];
    /** @var \UserBundle\Entity\User $user */
    $user = $this->getRepository(User::class)->findOneBy($filter);

    if (!$user) {
      return;
    }

    $hashToken = UserUtil::generateHashToken($username);
    $user->setHashToken($hashToken);

    $now = new \DateTime();
    $expireDate = $now->add(\DateInterval::createFromDateString('7 days'));
    $user->setExpiredTokenAt($expireDate);

    $this->createUser($user);

    $url = $this->router->generate('reset_password_route', ['token' => $user->getHashToken()], UrlGeneratorInterface::ABSOLUTE_URL);

    $data = [
      'url' => $url,
      'full_name' => $user->getFullName(),
    ];

    $this->sendMail(NotificationUtil::MAIL_FORGOT_PASSWORD_TEMPLATE_KEY, $username, $data);
  }

  public function resetPassword(User $user, $formData)
  {
    $plainPassword = $formData['plainPassword'];
    $user->setHashToken(null);
    $user->setExpiredTokenAt(null);
    $user->setPassword($plainPassword);

    $user->setStatus(StatusUtil::ACTIVE_CODE);
    $this->createOrUpdateUser($user);
  }

  public function getRedirectPathByRole($roles)
  {
    $role = empty($roles) ? '' : reset($roles);
    $targetPath = RolesUtil::getTargetPathByRole(is_string($role) ? $role : $role->getRole());

    return $targetPath;
  }

  public function forceLogin(User $user)
  {
    $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
    $this->getContainer()->get('security.token_storage')->setToken($token);
    $this->getContainer()->get('session')->set('_security_main', serialize($token));

    // Fire the login event manually
    $event = new InteractiveLoginEvent($this->getRequest(), $token);
    $this->getContainer()->get("event_dispatcher")->dispatch("security.interactive_login", $event);
  }

  /**
   * Get employee data for company employee details
   */
  public function getCompanyEmployeeDetails(User $employee)
  {
    /** @var \ContractBundle\Repository\CourseInvitationRepository $courseInviteRepo */
    $courseInviteRepo = $this->getRepository(CourseInvitation::class);

    $totalCourse = $courseInviteRepo->getTotalCourseByEmployeeId($employee->getId(), [InvitationUtil::STATUS_ACCEPTED, InvitationUtil::STATUS_ACTIVE_LEARNING, InvitationUtil::STATUS_INACTIVE_LEARNING]);
    $totalActiveLearning = $courseInviteRepo->getTotalCourseByEmployeeId($employee->getId(), [InvitationUtil::STATUS_ACCEPTED, InvitationUtil::STATUS_ACTIVE_LEARNING]);

    $data = [
      'employee' => $employee,
      'total_course' => $totalCourse,
      'total_active_learning' => $totalActiveLearning
    ];

    return $data;
  }




  public function changeEmployeeAvatar(UploadedFile $file)
  {
    $user = $this->getLoggedUser();

    if (!$user) {
      throw new BadCredentialsException();
    }

    $filename = $this->getContainer()->get('photo_upload.service')->upload($file, FileUtil::AVATAR_FOLDER);
    $userProfile = $user->getUserProfile();

    if (!$userProfile) {
      throw new \Exception('This user profile is not found');
    }

    $userProfile->setAvatar($filename);
    $this->getEntityManager()->persist($userProfile);
    $this->getEntityManager()->flush();

    return $filename;
  }

  public function getUserByUsername($username)
  {
    if (!$username) {
      throw new \InvalidArgumentException('Username is required');
    }

    $userRepo = $this->getRepository(User::class);
    return $userRepo->findOneBy(['username' => $username]);
  }

  public function createAdminCompanyUser($email, Company $company, $roleId, $oldEmail = '')
  {
    $user = $this->getUserByUsername($email);

    if (!empty($user)) {
      throw new \Exception('Email is existing', 1000);
    }

    $companyId = $company->getId();

    if (empty($companyId)) {
      $user = new User();
      $user->setUsername($email);
      $user->setFullName($company->getName());
      $user->setStatus(UserUtil::ACTIVE);

      $user->setRoleId($roleId);
      $user->setSlug($company->getSlug() . '-' . time());
      $url = $this->generatePasswordRouteUrl($user, $company);

      $userProfile = new UserProfile();
      $userProfile->setCompany($company);
      $userProfile->setUser($user);

      $this->persist($user);
      $this->persist($userProfile);
    } else {
      /** @var User $user */
      $user = $this->getUserByUsername($oldEmail);

      if (empty($user)) {
        throw new \Exception('Email is invalid', 1000);
      }

      $user->setUsername($email);
      $url = $this->generatePasswordRouteUrl($user, $company);
      $this->persist($user);
    }

    return $url;
  }

  public function generatePasswordRouteUrl(User $user)
  {
    $hashToken = StringUtil::generateHashToken($user->getUsername());
    $user->setHashToken($hashToken);
    $user->setPassword($hashToken);

    $now = new \DateTime();
    $expireDate = $now->add(\DateInterval::createFromDateString('7 days'));
    $user->setExpiredTokenAt($expireDate);

    $url = $this->router->generate('reset_password_route', ['token' => $user->getHashToken()], UrlGeneratorInterface::ABSOLUTE_URL);
    return $url;
  }

  public function getSpecialUser($companyId, $roleId)
  {
    /** @var UserRepository $userRepo */
    $userRepo = $this->getRepository(User::class);
    /** @var User $user */
    $user = $userRepo->getSpecialUser($companyId, $roleId);

    return $user;
  }

  public function getGroups()
  {
    $draw = (int)$this->getRequest()->get('draw');
    $keyword = $this->getRequest()->get('keyword');
    $offset = $this->getRequest()->get('start');

    $data = [
      'draw' => $draw,
      'recordsTotal' => 0,
      'recordsFiltered' => 0,
      'data' => []
    ];

    /** @var CompanyGroupRepository $userRepo */
    $userRepo = $this->getRepository(CompanyGroup::class);
    $company = $this->getUserCompany();

    if (empty($company)) {
      return $data;
    }

    $totalGroup = $userRepo->getTotalGroup($keyword, $company);

    if ($totalGroup == 0) {
      return $data;
    }

    $groups = $userRepo->getGroups($keyword, $company, $offset);

    if (empty($groups)) {
      return $data;
    }

    $groups = $this->decorateGroup($groups);
    $data['recordsTotal'] = $totalGroup;
    $data['recordsFiltered'] = $totalGroup;
    $data['data'] = $groups;

    return $data;
  }

  public function decorateGroup($groups)
  {
    $groupTmp = [];

    if (empty($groups)) {
      return $groupTmp;
    }
    /** @var GroupCourseRepository $groupCourseRepo */
    $groupCourseRepo = $this->getRepository(GroupCourse::class);
    foreach ($groups as $group) {
      $groupId = $group['id'];
      $groupEditUrl = $this->getRoute()->generate('company_group_edit_route', ['id' => $groupId]);
      /** @var CompanyGroup $groupEntity */
      $groupEntity = $this->getEntityById(CompanyGroup::class, $groupId);

      $learners = $groupEntity->getUserGroups() ? count($groupEntity->getUserGroups()) : 0;
      $courses = $groupCourseRepo->getTotalCourseByGroup($groupId);

      $learnersUrl = $this->getRoute()->generate('company_employee_list_route', ['group' => $groupId]);
      $coursesUrl = $this->getRoute()->generate('admin_company_group_course_list_route', ['group' => $groupId]);

      $groupTmp[] = [
        '',
        $group['name'],
        $group['username'],
        $learners,
        $courses,
        DateTimeUtil::formatDate($group['updatedAt']),
        $groupEditUrl,
        $learnersUrl,
        $coursesUrl,
        $groupId
      ];
    }

    return $groupTmp;
  }

  private function checkExistingGroup($name, $company)
  {
    $conditions = array('name' => $name, 'company' => $company);
    /** @var CompanyGroup $existingCompany */
    $existingGroup = $this->getEntityByConditions(CompanyGroup::class, $conditions);

    if (!empty($existingGroup)) {
      throw new \Exception('Nhóm đã tồn tại', 1000);
    }
  }

  private function createOwnerGroup($email, Company $company, CompanyGroup $group, $roleId, $oldEmail = '')
  {
    $user = $this->getUserByUsername($email);

    if (!empty($user)) {
      throw new \Exception('Email đã tồn tại', 1000);
    }

    $groupId = $group->getId();

    if (empty($groupId)) {
      $user = new User();
      $user->setUsername($email);
      $user->setFullName($group->getName());
      $user->setStatus(UserUtil::ACTIVE);

      $hashToken = UserUtil::generateHashToken($email);
      $user->setHashToken($hashToken);
      $user->setPassword($hashToken);

      $now = new \DateTime();
      $expireDate = $now->add(\DateInterval::createFromDateString('7 days'));
      $user->setExpiredTokenAt($expireDate);
      $url = $this->router->generate('reset_password_route', ['token' => $user->getHashToken()], UrlGeneratorInterface::ABSOLUTE_URL);

      $user->setRoleId($roleId);
      $user->setSlug($company->getSlug() . '-' . time());

      $userProfile = new UserProfile();
      $userProfile->setCompany($company);
      $userProfile->setUser($user);

      $userGroup = new UserGroup();
      $userGroup->setUser($user);
      $userGroup->setGroup($group);
      $userGroup->setStatus(UserUtil::ACTIVE);

      $group->setGroupOwner($user);

      $this->persist($user);
      $this->persist($userProfile);
      $this->persist($userGroup);
    } else {
      /** @var User $user */
      $user = $this->getUserByUsername($oldEmail);

      if (empty($user)) {
        throw new \Exception('Email is invalid', 1000);
      }

      $user->setUsername($email);
      $hashToken = UserUtil::generateHashToken($email);
      $user->setHashToken($hashToken);
//      $user->setPassword($hashToken);

      $now = new \DateTime();
      $expireDate = $now->add(\DateInterval::createFromDateString('7 days'));
      $user->setExpiredTokenAt($expireDate);
      $url = $this->router->generate('reset_password_route', ['token' => $user->getHashToken()], UrlGeneratorInterface::ABSOLUTE_URL);

      $this->persist($user);
    }

    return $url;
  }

  public function getGroup($id)
  {
    /** @var CompanyGroup $group */
    $group = $this->getEntityById(CompanyGroup::class, $id);
    $user = $group->getGroupOwner();
    $group->setEmail($user->getUsername());

    return $group;
  }

  public function createGroup(CompanyGroup $group, $requestCompany = null)
  {
    /** @var Company $company */
    $company = $requestCompany ? $requestCompany : $this->getUserCompany();
    $this->checkExistingGroup($group->getName(), $company);

    $group->setCompany($company);
    $group->setStatus(UserUtil::ACTIVE);
    $this->persist($group);

    $ownerGroup = $group->getEmail();
    $resetPasswordUrl = $this->createOwnerGroup($ownerGroup, $company, $group, RolesUtil::ROLE_COMPANY_ID);
    $this->flush();

    $data = [
      'company_name' => $company->getName(),
      'group_email' => $company->getEmail(),
      'url_change_password' => $resetPasswordUrl
    ];

    $this->sendMail(NotificationUtil::GROUP_COMPANY_CHANGE_PASSWORD_TEMPLATE_KEY, $ownerGroup, $data);
  }

  public function updateGroup(CompanyGroup $group, $oldGroupName, $oldEmail)
  {
    $newGroupName = $group->getName();
    /** @var Company $company */
    $company = $this->getUserCompany();

    if ($newGroupName != $oldGroupName) {
      $this->checkExistingGroup($group->getName(), $company);
    }

    $newEmail = $group->getEmail();
    $resetPasswordUrl = '';

    if ($newEmail != $oldEmail) {
      $resetPasswordUrl = $this->createOwnerGroup($newEmail, $company, $group, RolesUtil::ROLE_COMPANY_ID, $oldEmail);
    }

    $this->flush();

    if (!empty($resetPasswordUrl)) {
      $data = [
        'company_name' => $company->getName(),
        'group_email' => $newEmail,
        'url_change_password' => $resetPasswordUrl
      ];

      $this->sendMail(NotificationUtil::GROUP_COMPANY_CHANGE_PASSWORD_TEMPLATE_KEY, $newEmail, $data);
    }
  }

  public function getEmployerGroup($userId)
  {
    $companyGroupRepo = $this->getRepository(CompanyGroup::class);
    return $companyGroupRepo->findOneBy(['groupOwner' => $userId]);
  }

  public function updateGroupStatus()
  {
    $postData = $this->parseBodyRequestData();
    $this->validateRequireFields($postData, array('id', 'status'));
    $currentCompany = $this->getUserCompany();

    $conditions = array('id' => $postData->id, 'company' => $currentCompany);
    /** @var CompanyGroup $group */
    $group = $this->getEntityByConditions(CompanyGroup::class, $conditions);

    if (empty($group)) {
      $this->throwException('Group is invalid');
    }

    $currentStatus = $group->getStatus();

    if ($currentStatus == $postData->status) {
      $this->throwException('Status is invalid');
    }

    $group->setStatus($postData->status);
    $group->setUpdatedAt(new \DateTime());

    $this->persistAndFlush($group);
  }

  public function isUserValid()
  {
    $user = $this->getLoggedUser();

    if (!($user instanceof User)) {
      return;
    }

    $employeeStatus = $user->getStatus();

    if ($employeeStatus !== StatusUtil::ACTIVE_CODE) {
      throw new AccessDeniedException('This employee ' . $user->getUsername() . ' is unavailable');
    }
  }

  public function updateUserStatus()
  {
    $postData = $this->parseBodyRequestData();

    $this->validateRequireFields($postData, array('id', 'status'));

    $cond = ['id' => $postData->id];
    $user = $this->getEntityByConditions(User::class, $cond, true);

    if (!$user) {
      $this->throwException('User is invalid');
    }

    $currentStatus = $user->getStatus();

    if ($currentStatus == $postData->status) {
      $this->throwException('Status is invalid');
    }

    $user->setStatus($postData->status);
    $user->setUpdatedAt(new \DateTime());

    $this->persistAndFlush($user);
  }

  public function validInvitationToken($token, $isLicenseKey = null)
  {
    /** @var CourseInvitationRepository $courseInviteRepo */
    $courseInviteRepo = $this->getRepository(CourseInvitation::class);
    $needAccept = true;
    if ($isLicenseKey) {
      /** @var \ContractBundle\Entity\CourseInvitation $courseInvite */
      $courseInvite = $courseInviteRepo->getInviteByLicenseKey($token);
      $needAccept = false;
    } else {
      /** @var \ContractBundle\Entity\CourseInvitation $courseInvite */
      $courseInvite = $courseInviteRepo->findOneBy(['hashToken' => $token, 'status' => InvitationUtil::STATUS_PENDING]);
    }

    if (!$courseInvite) {
      throw new \Exception('Không tìm thấy lời mời.', 1912);
    }

    $ciService = $this->getContainer()->get(ServiceUtil::COURSE_INVITATION_SERVICE);

    $ciService->validCourseInvite($courseInvite, $needAccept);
    /** @var User $user */
    $user = $courseInvite->getEmployee();

    if (!$needAccept) {
      if ($user->getPassword()) {
        $ciService->updateCourseInvitationStatus($courseInvite, InvitationUtil::STATUS_ACCEPTED);
        throw new \Exception('Vui lòng đăng nhập.', 1912);
      }
    }
  }

  /**
   * FrontOffice update their password (if null) for invitation link
   * @param $token
   * @param $formData
   */
  public function updatePassword($token, $formData)
  {
    $plainPassword = $formData['plainPassword'];
    $user = $this->getRepository(User::class)->findOneBy(['hashToken' => $token]);

    if (!$user) {
      throw new \Exception('User is not found!');
    }

    $user->setPassword($plainPassword);
    $this->createUser($user);
  }

  /**
   * @param User $user
   */
  public function getUserProfileApi($user)
  {
    $data = [];

    /** @var UserProfile $userProfile */
    $userProfile = $user->getUserProfile();

    if (!$userProfile) {
      throw new \Exception('User profile missing.', 1912);
    }

    $employeeSummary = $this->getEmployeeCourseSummary($user);

    $domain = $this->getContainer()->getParameter('navibiz_domain');
    $imageUrl = FileUtil::getFilePath($userProfile->getAvatar(), $domain) ?? '';
    $currentTime = new \DateTime();

    $data = [
      'full_name' => $user->getFullName(),
      'avatar' => $imageUrl ? $imageUrl . '?timestamp=' . $currentTime->getTimestamp() : '',
      'course_complete' => $employeeSummary['completed'],
      'course_not_learn' => $employeeSummary['not_learn'],
      'roles' => $user->getRoles()
    ];

    return $data;
  }

  public function crmContact()
  {
    $data = $this->parseBodyRequestData(true);

    $getFlyService = $this->getContainer()->get(ServiceUtil::GETFLY_CRM_SERVICE);

    $response = $getFlyService->insertNewAccount($data);

    return $response;
  }

  /**
   * on admin side, admin force login into employer account
   */
  public function forceLoginEmployer($employerId, $checkRole = true)
  {
    if (!$employerId) {
      throw new \Exception('Missing employer Id.', 1912);
    }
    /** @var User $employer */
    $employer = $this->getEntityByConditions(User::class, ['id' => $employerId]);
    if (!$employer) {
      throw new \Exception('Employer not found.', 1912);
    }

    $employerRole = $employer->getRoleId();
    if ($checkRole and $employerRole != RolesUtil::ROLE_COMPANY_ID) {
      throw new \Exception('You only force login for employer account.', 1912);
    }
    //valid permission to force login
    $this->validAdminRole();

    //force logout current user
    $this->forceLogoutCurrentUser();

    //force login employer
    $this->forceLogin($employer);
  }

  public function forceLogoutCurrentUser()
  {
    try {
      $token = $this->getContainer()->get('security.token_storage')->getToken();
      /** @var User $user */
      $user = $token->getUser();
      if ($user != null) {
        $this->getContainer()->get('security.token_storage')->setToken(null);
      }
    } catch (\Exception $e) {
      $this->writeLog(__FUNCTION__ . '-' . $e->getMessage());
    }
  }

  protected function validAdminRole()
  {
    $currentUser = $this->getLoggedUser();

    if (!$currentUser) {
      throw new \Exception('Missing User.', 1912);
    }

    $userRole = $currentUser->getRoleId();

    if ($userRole != RolesUtil::ROLE_ADMIN_ID) {
      throw new \Exception('Missing permission.', 1912);
    }
  }

  public function getCurrentAssignedPermission()
  {
    $result = [];
    $rolePermissions = $this->getRepository(RolePermission::class)->findAll();

    if (!$rolePermissions) {
      return $result;
    }

    return array_map(function (RolePermission $rolePermission) {
      return $rolePermission->getRole() . '_' . $rolePermission->getPermission();
    }, $rolePermissions);
  }

  public function extractAndAssignPermission($rolePermissions)
  {
    $rolePermissionRepo = $this->getRepository(RolePermission::class);
    $currentRolePermissions = $rolePermissionRepo->findAll();

    foreach ($currentRolePermissions as $currentRolePermission) {
      $this->getEntityManager()->remove($currentRolePermission);
    }

    foreach ($rolePermissions as $rolePermission) {
      $extractedRolePermission = explode('_', $rolePermission);
      $permission = new RolePermission();
      $permission->setRole($extractedRolePermission[0]);
      $permission->setPermission($extractedRolePermission[1]);

      $this->persist($permission);
    }

    $this->flush();
  }

  public function getEmployeeCourseSummary(User $employee)
  {
    try {
      /** @var LearningProgressRepository $lProgressRepo */
      $lProgressRepo = $this->getRepository(LearningProgress::class);
      /** @var CourseInvitationRepository $courseInviteRepo */
      $courseInviteRepo = $this->getRepository(CourseInvitation::class);

      $completedCourse = count($lProgressRepo->getCourseStatusByEmployee($employee->getId(), [TrackingUtil::STATUS_FINISHED]));
      $inProgressCourse = count($lProgressRepo->getCourseStatusByEmployee($employee->getId(), [TrackingUtil::STATUS_LEARNING]));
      $totalCourse = $courseInviteRepo->getTotalCourseByEmployeeId($employee->getId());
      $notLearnCourse = $totalCourse - ($inProgressCourse + $completedCourse);
      $data = [
        'completed' => $completedCourse ? sprintf("%02d", $completedCourse) : '00',
        'not_learn' => $notLearnCourse ? sprintf("%02d", $notLearnCourse) : '00'
      ];
    } catch (\Exception $e) {
      $this->writeLog(__FUNCTION__ . ' | ' . $e->getMessage());
      $data = [
        'completed' => '00',
        'not_learn' => '00'
      ];
    }

    return $data;
  }

  /**
   * @param $user
   *
   * @return string
   */
  public function getUserRoleTitle($user)
  {
    $roleId = $user->getRoleId();
    $result = isset(RolesUtil::CAN_ASSIGN_PERMISSION_ROLE_MAPPING[$roleId]) ? RolesUtil::CAN_ASSIGN_PERMISSION_ROLE_MAPPING[$roleId] : '';

    return $result;
  }

  /**
   * @param CompanyGroup $companyGroup
   * @param $keyCode
   * @param $employeeCode
   */
  public function createGuestLearner($companyGroup, $keyCode, $employeeCode = null)
  {
    //user
    $user = new User();
    $fullname = UserUtil::LEARNER_GUEST_NAME . ' ' . $keyCode;
    $user->setFullName($fullname);
    $slug = UserUtil::buildUserSlug($user);
    $user->setSlug($slug);
    $user->setStatus(UserUtil::ACTIVE);
    $user->setRoleId(RolesUtil::ROLE_EMPLOYEE_ID);
    $username = strtolower($keyCode) . UserUtil::EMPLOYEE_GUEST_EMAIL_DOMAIN;
    $user->setUsername($username);

    //profile
    $userProfile = new UserProfile();
    $userProfile->setUser($user);
    $userProfile->setCompany($companyGroup->getCompany());
    $userProfile->setEmployeeCode($employeeCode);

    //user group
    $userGroup = new UserGroup();
    $userGroup->setUser($user);
    $userGroup->setGroup($companyGroup);
    $userGroup->setStatus(GroupUtil::ACTIVE);

    $this->persist($user);
    $this->persist($userProfile);
    $this->persist($userGroup);

    return $user;
  }

  /**
   * @param User $user
   *
   * @throws \Exception
   */
  public function forceLoginGuest($user)
  {
    if (!$user->getId()) {
      throw new \Exception('Người dùng không tồn tại', 1912);
    }

    //force logout current user
    $this->forceLogoutCurrentUser();

    //force login employer
    $this->forceLogin($user);
  }

  public function findLearnerByKeywordSelect2($keyword = '')
  {
    /** @var UserRepository $userRepo */
    $userRepo = $this->getRepository(User::class);
    $result = [];
    $user = $this->getLoggedUser();
    if (!$user) {
      return $result;
    }
    $companyId = $user->getCompany()->getId();
    $learners = $userRepo->getLearnerSelect2($keyword, StatusUtil::ACTIVE_CODE, '', $companyId, 0, 10);

    if (!$learners) {
      return $result;
    }

    /** @var User $learner */
    foreach ($learners as $learner) {
      $groups = $learner->getUserGroups();
      $groups = array_map(function (UserGroup $group) {
        return $group->getGroup()->getName();
      }, $groups->toArray());
      $groups = implode(', ', $groups);

      $result[] = [
        'id' => $learner->getUsername(),
        'text' => $learner->getUsername() . ' (' . $groups . ')',
        'name' => $learner->getFullName(),
        'phone_number' => $learner->getUserProfile()->getPhoneNumber() ? $learner->getUserProfile()->getPhoneNumber() : ''
      ];
    }

    return $result;
  }

  public function groupSingleAddLearnerToGroupAjax()
  {
    $formData = $this->parseBodyRequestData(true);
    $this->validateRequireFields($formData, ['email', 'group', 'fullName'], false);

    //valid company group
    $loggedUser = $this->getLoggedUser();
    if (!$loggedUser) {
      throw new \Exception('Bạn cần phải login', 1912);
    }
    /** @var Company $company */
    $company = $loggedUser->getCompany();
    $currentGroupIds = is_array($formData['group']) ? $formData['group'] : [$formData['group']];

    $email = $formData['email'];
    $isEmailValid = SecurityUtil::isEmailValid($email);
    if (!$isEmailValid) {
      throw new \Exception('Định dạng email không đúng', 1912);
    }
    /** @var User $requestUser */
    $requestUser = $this->getEntityByConditions(User::class, ['username' => $email]);

    //case user not exist
    if (!$requestUser) {
      //learner
      $fullname = $formData['fullName'];
      $phoneNumber = $formData['phoneNumber'];
      $requestUser = new User();
      $requestUser->setUsername($email);
      $requestUser->setFullName($fullname);
      $requestUser->setPhoneNumber($phoneNumber);

      $this->createLearner($requestUser, $company);
    } else {//case user exist
      /** @var Company $userCompany */
      $userCompany = $requestUser->getCompany();
      $requestUserRole = $requestUser->getRoleId();

      //not belong to current company or user is admin company
      if (($company->getId() != $userCompany->getId()) || ($requestUserRole == RolesUtil::ROLE_ADMIN_COMPANY_ID)) {
        throw new \Exception('Email không hợp lệ', 1912);
      }
    }

    $companyGroups = $this->getEntityByConditions(CompanyGroup::class, ['id' => $currentGroupIds, 'company' => $company], false);

    if (!$companyGroups) {
      throw new \Exception('Dữ liệu không hợp lệ', 1912);
    }

    $added = [];
    /** @var CompanyGroup $companyGroup */
    foreach ($companyGroups as $companyGroup) {
      //user belong to current company
      $userGroup = $this->getEntityByConditions(UserGroup::class, ['group' => $companyGroup, 'user' => $requestUser]);
      //user belong to request group
      if ($userGroup) {
        continue;
      }

      $userGroup = new UserGroup();
      $userGroup->setUser($requestUser);
      $userGroup->setGroup($companyGroup);
      $userGroup->setStatus(GroupUtil::ACTIVE);

      $this->persist($userGroup);
      $this->flush();

      $added[] = $companyGroup->getName();
    }

    $data = [
      'learner' => $requestUser->getFullName(),
      'groups' => implode(', ', $added)
    ];

    return $data;
  }

  /**
   * @param User $user
   * @param Company $company
   * @param CompanyGroup | null $companyGroup
   */
  public function createLearner($user, $company, $companyGroup = null)
  {
    $fullName = $user->getFullName();
    $slugify = new Slugify();
    $slug = $slugify->slugify($fullName, '-');
    $currentTimestamp = DateTimeUtil::getCurrentTimestamp();
    $slug .= "-{$currentTimestamp}";

    //learner
    $user->setSlug($slug);
    $user->setRoleId(RolesUtil::ROLE_EMPLOYEE_ID);
    $user->setStatus(UserUtil::ACTIVE);
    $phoneNumber = $user->getPhoneNumber();

    //profile
    $profile = new UserProfile();
    $profile->setUser($user);
    $profile->setPhoneNumber($phoneNumber);
    $profile->setCompany($company);

    //user group
    if ($companyGroup) {
      $userGroup = new UserGroup();
      $userGroup->setGroup($companyGroup);
      $userGroup->setUser($user);
      $userGroup->setStatus(GroupUtil::ACTIVE);

      $this->persist($userGroup);
    }

    $this->persist($user);
    $this->persist($profile);
  }

  public function findUserGroupByKeywordSelect2($email, $keyword)
  {
    /** @var CompanyGroupRepository $companyGroupRepo */
    $companyGroupRepo = $this->getRepository(CompanyGroup::class);
    $result = [];
    $user = $this->getLoggedUser();
    if (!$user) {
      return $result;
    }
    $companyId = $user->getCompany()->getId();
    $groups = $companyGroupRepo->getUserGroupSelect2($keyword, $email, $companyId, 0, 10);

    if (!$groups) {
      return $result;
    }

    /** @var CompanyGroup $group */
    foreach ($groups as $group) {

      $result[] = [
        'id' => $group->getId(),
        'text' => $group->getName()
      ];
    }

    return $result;
  }

  /**
   * Get roles for assignment permission in BO
   * @return array
   */
  public function getRolesAssignment()
  {
    $roles = RolesUtil::CAN_ASSIGN_PERMISSION_ROLE_MAPPING;

    $user = $this->getLoggedUser();

    if (!($user instanceof User)) {
      return [];
    }

    $roleId = $user->getRoleId();
    if ($roleId != RolesUtil::ROLE_FINANCE_ID) {
      unset($roles[RolesUtil::ROLE_FINANCE_ID]);
    }

    return $roles;
  }

  /**
   * Get permissions for assignment permission in BO
   * @return array
   */
  public function getPermissionAssignment()
  {
    $permissions = PermissionUtil::PERMISSION_MAP;

    if (!$this->isGranted(PermissionUtil::BO_CONTRACT_APPROVE)) {
      unset($permissions[PermissionUtil::BO_CONTRACT_APPROVE]);
    }

    return $permissions;
  }

  public function createUpdateTrainer($teacher)
  {
    $email = $teacher['email'];
    $fullName = $teacher['fullName'];

    $trainer = $this->getEntityByConditions(User::class, ['username' => $email]);
    if (!$trainer) {
      $trainer = new User();
      $trainer->setUsername($email);
      $trainer->setFullName($fullName);
      $this->createTrainer($trainer);
    }
    return $trainer;
  }

  public function findUserById($id)
  {
    return $this->getRepository(User::class)->find($id);
  }

  public function findUserBy($params) {
    return $this->getRepository(User::class)->findOneBy($params);
  }
}
