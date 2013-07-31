<?php
App::uses('AppController', 'Controller');
/**
 * BookMasters Controller
 *
 * @property BookMaster $BookMaster
 */
class BookMastersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->BookMaster->recursive = 0;
		$this->set('bookMasters', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->BookMaster->id = $id;
		if (!$this->BookMaster->exists()) {
			throw new NotFoundException(__('Invalid book master'));
		}
		$this->set('bookMaster', $this->BookMaster->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BookMaster->create();
			if ($this->BookMaster->save($this->request->data)) {
				$this->Session->setFlash(__('The book master has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The book master could not be saved. Please, try again.'));
			}
		}
		$colors = $this->BookMaster->Color->find('list');
		$this->set(compact('colors'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->BookMaster->id = $id;
		if (!$this->BookMaster->exists()) {
			throw new NotFoundException(__('Invalid book master'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->BookMaster->save($this->request->data)) {
				$this->Session->setFlash(__('The book master has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The book master could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->BookMaster->read(null, $id);
		}
		$colors = $this->BookMaster->Color->find('list');
		$this->set(compact('colors'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->BookMaster->id = $id;
		if (!$this->BookMaster->exists()) {
			throw new NotFoundException(__('Invalid book master'));
		}
		if ($this->BookMaster->delete()) {
			$this->Session->setFlash(__('Book master deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Book master was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
