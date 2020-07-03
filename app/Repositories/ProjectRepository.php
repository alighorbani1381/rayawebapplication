<?php

namespace App\Repositories;

use App\Cost;
use App\User;
use App\Project;
use App\Category;
use Illuminate\Support\Facades\DB;
use Hekmatinasser\Verta\Facades\Verta;
use App\Http\Controllers\Admin\AdminController;
use Carbon\Carbon;

class ProjectRepository extends AdminController
{

    const CONTRACT_IMAGE_PATH = 'admin/images/projects/contracts';

    const MELI_IMAGE_PATH = 'admin/images/projects/meli_code';

    /************************ Helper Function to Convert Persian date to Gregorian  ** ********************* */

    public function convertToEnglishAlphabet($string)
    {
        return strtr($string, array('۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9', '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9'));
    }

    public function explodeDate($orderdate)
    {
        $explodeDate = explode('/', $orderdate);
        $date[0]   = $explodeDate[0];
        $date[1] = $explodeDate[1];
        $date[2]  = $explodeDate[2];
        return $date;
    }

    public function convertToInt($date)
    {
        foreach ($date as $dateParam) {
            $englishCharacters[] = $this->convertToEnglishAlphabet($dateParam);
        }

        foreach ($englishCharacters as $englishChar) {
            $numberDate[] = (int) $englishChar;
        }

        return $numberDate;
    }

    public function getGregorianFormat($arrayDate)
    {
        return implode('-', $arrayDate);
    }

    public function convertToGregorian($jalaliDate)
    {
        $date = $this->explodeDate($jalaliDate);
        $numberDate = $this->convertToInt($date);
        $newDate = Verta::getGregorian($numberDate[0], $numberDate[1], $numberDate[2]);
        $gregorian = $this->getGregorianFormat($newDate);
        return $gregorian;
    }


    /************************ Projects Functions  ** ********************* */


    public static function createTaskMaster($request, $image)
    {
        return  DB::table('project_taskmaster')
            ->insertGetId([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'father_name' => $request->father_name,
                'meli_code' => $request->meli_code,
                'meli_image' => $image,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
    }

    private function deleteTaskMaster($taskmasterId)
    {
        return  DB::table('project_taskmaster')
            ->where('project_taskmaster.id', $taskmasterId)
            ->delete();
    }

    private function deleteContractors($projectId)
    {
        return DB::table('project_contractor')
            ->where('project_contractor.project_id', $projectId)
            ->delete();
    }

    private function deleteCategories($projectId)
    {
        return DB::table('project_category')
            ->where('project_category.project_id', $projectId)
            ->delete();
    }

    private function deleteProject($projectId)
    {
        return DB::table('projects')
            ->where('projects.id', $projectId)
            ->delete();
    }

    private function deleteEarning($projectId)
    {
        return DB::table('earnings')
            ->where('earnings.project_id', $projectId)
            ->delete();
    }

    private function deleteCosts($projectId)
    {
        return DB::table('costs')
            ->where('costs.project_id', $projectId)
            ->delete();
    }

    public function generateUniqueId()
    {

        while (true) {
            $uniqueId =  'raya' . '-' . substr(uniqid(), 4, 8);
            if (!$this->isExistsId($uniqueId))
                break;
        }

        return $uniqueId;
    }
    public function isExistsId($id)
    {
        $exists = Project::where('unique_id', $id)->count();
        if ($exists != 0)
            return true;
        else
            return false;
    }

    public function createProject($request, $taskmaster, $image)
    {
        # Convert Date to Gregorian 
        $dateStart = $this->convertToGregorian($request->date_start);
        $completedAt = $this->convertToGregorian($request->completed_at);
        $contractStarted = $this->convertToGregorian($request->contract_started);

        # Generate Extra stuff
        $dateTime = Carbon::now();
        $uniqueId = $this->generateUniqueId();

        # Insert row into DB
        return DB::table('projects')->insertGetId([
            'project_creator' => auth()->user()->id,
            'taskmaster'       => $taskmaster,
            'unique_id'        => $uniqueId,
            'title'            => $request->title,
            'description'      => $request->description,
            'price'            => $request->price,
            'contract_image'   => $image,
            'contract_started' => $contractStarted,
            'contract_ended'   => $completedAt,
            'status'           => 'waiting',
            'date_start'       => $dateStart,
            'complete_after'   => $request->complete_after,
            'created_at'       => $dateTime,
            'updated_at'       => $dateTime,
        ]);
    }

    public static function setContractors($projectId, $contractors)
    {
        foreach ($contractors as $contractor)
            DB::table('project_contractor')->insert([
                'project_id' => $projectId,
                'contractor_id' => $contractor,
            ]);
    }

    public static function setCategories($projectId, $categories)
    {
        foreach ($categories as $category)
            DB::table('project_category')->insert([
                'project_id' => $projectId,
                'category_id' => $category,
            ]);
    }

    public static function getProjects()
    {
        return DB::table('projects')
            ->join('users', 'projects.project_creator', '=', 'users.id')
            ->join('project_taskmaster', 'projects.taskmaster', '=', 'project_taskmaster.id')
            ->orderBy('projects.id', 'desc')
            ->select('project_taskmaster.*', 'projects.*', 'users.name AS creator_name', 'users.lastname AS creator_lastname', 'users.id AS creator_id')
            ->paginate(15);
    }

    public static function getActiveProjects()
    {
        return DB::table('projects')
            ->join('project_taskmaster', 'projects.taskmaster', '=', 'project_taskmaster.id')
            ->where('status', '!=', 'finished')
            ->orderBy('projects.id', 'desc')
            ->limit(6)
            ->get();
    }

    private function getLatestSixProject()
    {
        return DB::table('projects')
            ->join('project_taskmaster', 'projects.taskmaster', '=', 'project_taskmaster.id')
            ->orderBy('projects.id', 'desc')
            ->limit(6)
            ->get();
    }

    public function getLatestExecutedProject()
    {
        $projects = $this->getLatestSixProject();
        foreach ($projects as $project) {
            $project = $this->getProjectFull($project->id);
            $result[] = $project['project'];
        }
        return $result;
    }
    public function getStatisticProject()
    {
        $actives = $this->getActiveProjects();
        foreach ($actives as $active) {
            $project = $this->getProjectFull($active->id);
            $allProgress = $this->getProgress($project);
            $results['project'][] = $project['project'];
            $results['progress'][] = $allProgress;
        }
        return $results;
    }

    public function getProject($id)
    {
        return DB::table('projects')
            ->join('project_taskmaster', 'projects.taskmaster', '=', 'project_taskmaster.id')
            ->select('project_taskmaster.*', 'projects.*')
            ->where('projects.id', $id)
            ->first();
    }

    public static function getCategories($projectId)
    {
        return DB::table('project_category')
            ->join('categories', 'project_category.category_id', '=', 'categories.id')
            ->select('project_category.*', 'categories.title')
            ->where('project_category.project_id', $projectId)
            ->get();
    }

    public static function getProjectContractors($projectId)
    {
        return DB::table('project_contractor')
            ->where('project_contractor.project_id', $projectId)
            ->join('users', 'project_contractor.contractor_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.lastname', 'users.profile', 'project_contractor.id AS contract_id', 'project_contractor.progress', 'project_contractor.progress_access')
            ->orderBy('project_contractor.progress_access', 'desc')
            ->get();
    }

    public function getEarnings($projectId)
    {
        return DB::table('projects')
            ->where('projects.id', $projectId)
            ->join('earnings', 'earnings.project_id', '=', 'projects.id')
            ->select('earnings.*')
            ->orderBy('earnings.created_at', 'desc')
            ->get();
    }

    public function projectCreateFull($request)
    {
        DB::transaction(function () use ($request) {
            $images = $this->projectImageUploade($request);
            $taskmaster = $this->createTaskMaster($request, $images['meli_code']);
            $project = $this->createProject($request, $taskmaster, $images['contract']);
            $this->setContractors($project, $request->contractors);
            $this->setCategories($project, $request->categories);
        });
    }

    public function projectImageUploade($request)
    {
        $result['contract'] = $this->uplodeImage($request->contract_image, self::CONTRACT_IMAGE_PATH, 'Contract');
        $result['meli_code'] = $this->uplodeImage($request->meli_image, self::MELI_IMAGE_PATH, 'meliCode');
        return $result;
    }

    public function getProjectFull($id)
    {
        Project::findOrFail($id);
        $project['project']          = $this->getProject($id);
        $project['earnings']         = $this->getEarnings($id);
        $project['categories']       = $this->getCategories($id);
        $project['contractor_costs'] = $this->getContractorCosts($id);
        $project['base_costs']       = $this->getBaseProjectCosts($id);
        $project['contractors']      = $this->getProjectContractors($id);
        return $project;
    }
    public function deleteProjectImage($id)
    {
        $project = $this->getProjectFull($id)['project'];
        $meliImage = self::MELI_IMAGE_PATH . '/' . $project->meli_image;
        $contractImage = self::CONTRACT_IMAGE_PATH . '/' . $project->contract_image;
        $this->imageDelete($meliImage);
        $this->imageDelete($contractImage);
    }

    public function getBaseProjectCosts($id)
    {
        return Cost::where('project_id', $id)
            ->where('contractor_id', null)
            ->get();
    }

    public function getContractorCosts($id)
    {
        return Cost::join('users', 'costs.contractor_id', '=', 'users.id')
            ->select('costs.*', 'users.name', 'users.lastname')
            ->where('project_id', $id)
            ->where('contractor_id', '!=', null)
            ->get();
    }

    public function dividePercnets($request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->access as $key => $access)
                if (array_key_exists($key, $request->progress)) {
                    $percent = $request->progress[$key];
                    DB::table('project_contractor')
                        ->where('project_contractor.id', $access)
                        ->update(['progress_access' => $percent, 'progress' => '0']);
                }
            DB::table('projects')
                ->where('id', $request->project_id)
                ->update(['status' => 'ongoing']);
        });
    }

    public function getProgress($contractorData)
    {
        $allProgress = 0;
        foreach ($contractorData['contractors'] as $contractor) {
            $percent = $contractor->progress_access / 100;
            $progress = $contractor->progress * $percent;
            $allProgress += $progress;
        }
        $allProgress = round($allProgress, 0);
        return $allProgress;
    }

    public function deleteFullProject($projectId)
    {
        Project::findOrFail($projectId);
        DB::transaction(function () use ($projectId) {
            $this->deleteProjectImage($projectId);
            $this->deleteTaskMaster($projectId);
            $this->deleteContractors($projectId);
            $this->deleteCategories($projectId);
            $this->deleteEarning($projectId);
            $this->deleteCosts($projectId);
            $this->deleteProject($projectId);
        });
    }

    public function updateTaskMaster($taskmasterId, $request)
    {
        $fileds = [
            'name' => $request->name,
            'lastname' => $request->lastname,
            'father_name' => $request->father_name,
            'meli_code' => $request->meli_code,
            'meli_image' => 'default',
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        return DB::table('project_taskmaster')
            ->where('id', $taskmasterId)
            ->update($fileds);
    }

    public function updateProject($projectId, $request)
    {
        $dateStart = $this->convertToGregorian($request->date_start);
        $completedAt = $this->convertToGregorian($request->completed_at);
        $contractStarted = $this->convertToGregorian($request->contract_started);
        $dateTime = date('Y:m:d h:m:s');
        $fileds = [
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'contract_image' => 'default',
            'contract_started' => $contractStarted,
            'contract_ended' => $completedAt,
            'date_start' => $dateStart,
            'complete_after' => $request->complete_after,
            'updated_at' => $dateTime,
        ];

        return DB::table('projects')
            ->where('id', $projectId)
            ->update($fileds);
    }

    public function getOldMeliPicture($image)
    {
        return self::MELI_IMAGE_PATH . '/' . $image;
    }

    public function reUplodeImage($request, $project)
    {

        $result['meli_image'] =  ($project->meli_image  != null)     ?  $project->meli_image     : 'default';
        $result['contract']   =  ($project->contract_image != null) ?  $project->contract_image : 'default';

        // dd($request->all());
        // dd($result);

        if ($request->has('meli_image')) {
            $oldImage = $this->getOldMeliPicture($project->meli_image);
            $result['meli_image'] = $this->uplodeImage($request->meli_image, self::MELI_IMAGE_PATH, 'meliCode');
            $this->imageDelete($oldImage);
        }

        if ($request->has('contract_image')) {
            $oldImage = self::CONTRACT_IMAGE_PATH . '/' . $project->contract_image;
            $result['contract'] =  $this->uplodeImage($request->contract_image, self::CONTRACT_IMAGE_PATH, 'Contract');
            $this->imageDelete($oldImage);
        }

        return $result;
    }

    public function updateImages($request, $project)
    {
        $images = $this->reUplodeImage($request, $project);

        DB::table('projects')
            ->where('projects.id', $project->id)
            ->update([
                'contract_image' => $images['contract']
            ]);

        DB::table('project_taskmaster')
            ->where('project_taskmaster.id', $project->taskmaster)
            ->update([
                'meli_image' => $images['meli_image']
            ]);
    }

    public function updateProjectFull($projectId, $request)
    {
        $project = $this->getProjectFull($projectId)['project'];
        $this->updateImages($request, $project);

        // DB::transaction(function () use ($project, $request) {
        //     $this->updateTaskMaster($project->taskmaster, $request);
        //     $this->updateProject($project->id, $request);
        // });
    }

    public function getMainCategories()
    {
        return Category::where('child', '0')->get();
    }

    public function getContractors()
    {
        return User::where('type', 'contractor')->get();
    }




    /************************ Contractor Panel Use This Methods ** ********************* */

    public function getContractorProject($userId)
    {
        return DB::table('project_contractor')
            ->join('projects', 'project_contractor.project_id', '=', 'projects.id')
            ->where('contractor_id', $userId)
            ->orderBy('projects.id', 'desc')
            ->paginate(15);
    }

    public function getContractorOngoingProject($userId)
    {
        return DB::table('project_contractor')
            ->join('projects', 'project_contractor.project_id', '=', 'projects.id')
            ->where('contractor_id', $userId)
            ->where('status', 'ongoing')
            ->orderBy('projects.id', 'desc')
            ->paginate(15);
    }

    public function getContractorFinishedProject($userId)
    {
        return DB::table('project_contractor')
            ->join('projects', 'project_contractor.project_id', '=', 'projects.id')
            ->where('contractor_id', $userId)
            ->where('status', 'finished')
            ->orderBy('projects.id', 'desc')
            ->paginate(15);
    }

    public function isAccessToProject($projectId, $userId)
    {
        return DB::table('project_contractor')
            ->where('project_id', $projectId)
            ->where('contractor_id', $userId)
            ->exists();
    }

    public function contractorGate($projectId, $userId)
    {
        $isAccess = $this->isAccessToProject($projectId, $userId);
        if (!$isAccess) {
            abort('404');
            return null;
        }
    }

    public function getContractorProgress($projectId, $userId)
    {
        return DB::table('project_contractor')
            ->select('project_contractor.*', 'projects.title')
            ->join('projects', 'project_contractor.project_id', '=', 'projects.id')
            ->where('project_id', $projectId)
            ->where('contractor_id', $userId)
            ->first();
    }

    public function getProgressInfo($project, $userId)
    {
        $this->contractorGate($project, $userId);
        $progressInfo = $this->getContractorProgress($project, $userId);
        return $progressInfo;
    }

    public function updateProgress($id, $progress)
    {
        return DB::table('project_contractor')
            ->where('id', $id)
            ->update(['progress' => $progress]);
    }

    public function isAccessChangeProgress($project)
    {
        $date = verta($project->date_start);
        $result['isFuture'] = $date->isFuture();
        $result['diff'] = $date->formatDifference();
        return $result;
    }
}
